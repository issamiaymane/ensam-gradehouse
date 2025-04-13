<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassroomSchoolYear;
use App\Models\ClassroomStudent;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    public function showUploadForm()
    {
        $classroomSchoolYears = ClassroomSchoolYear::with('classroom')->get();

        // Change this to use pagination (50 items per page)
        $classroomStudents = ClassroomStudent::with(['student.user', 'classroomSchoolYear.classroom'])
            ->orderBy('created_at', 'desc')
            ->paginate(1000);

        return view('admin.upload.student-upload', compact('classroomSchoolYears', 'classroomStudents'));
    }

    public function uploadExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
            'classroom_school_year_id' => 'required|exists:classroom_school_year,id'
        ]);

        $file = $request->file('file');
        $classroomSchoolYearId = $request->classroom_school_year_id;

        try {
            $data = Excel::toArray([], $file);

            if (empty($data) || count($data[0]) < 7) {
                return back()->with('error', 'Invalid file format or empty file.');
            }

            $rows = $data[0];
            $successCount = 0;
            $errorCount = 0;

            for ($i = 17; $i < count($rows); $i++) {
                $row = $rows[$i];

                if (empty($row[0])) {
                    continue;
                }

                $apogee = $row[0];
                $lastName = $row[1] ?? '';
                $firstName = $row[2] ?? '';

                try {
                    $student = Student::where('apogee', $apogee)->first();

                    if (!$student) {
                        $email = Str::slug($firstName . '_' . $lastName, '_') . '@um5.ac.ma';
                        $existingUser = User::where('email', $email)->first();

                        if (!$existingUser) {
                            $user = User::create([
                                'first_name' => $firstName,
                                'last_name' => $lastName,
                                'email' => $email,
                                'password' => Hash::make($apogee),
                                'role' => 'student'
                            ]);
                        } else {
                            $user = $existingUser;
                        }

                        $student = Student::create([
                            'user_id' => $user->id,
                            'apogee' => $apogee
                        ]);
                    }

                    $alreadyExists = ClassroomStudent::where('classroom_school_year_id', $classroomSchoolYearId)
                        ->where('student_id', $student->id)
                        ->exists();

                    if (!$alreadyExists) {
                        ClassroomStudent::create([
                            'classroom_school_year_id' => $classroomSchoolYearId,
                            'student_id' => $student->id
                        ]);
                        $successCount++;
                    } else {
                        $errorCount++;
                    }

                } catch (\Exception $e) {
                    $errorCount++;
                    continue;
                }
            }

            $message = "Successfully imported {$successCount} students.";
            if ($errorCount > 0) {
                $message .= " {$errorCount} records were skipped (duplicates or errors).";
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            return back()->with('error', 'Error processing file: ' . $e->getMessage());
        }
    }
}
