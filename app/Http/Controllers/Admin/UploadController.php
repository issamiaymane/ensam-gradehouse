<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassroomSchoolYear;
use App\Models\ClassroomStudent;
use App\Models\ClassroomSubject;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherSubjectAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    public function showStudentUploadForm()
    {
        $classroomSchoolYears = ClassroomSchoolYear::with('classroom')->get();

        // Change this to use pagination (50 items per page)
        $classroomStudents = ClassroomStudent::with(['student.user', 'classroomSchoolYear.classroom'])
            ->orderBy('created_at', 'desc')
            ->paginate(1000);

        return view('admin.upload.student-upload', compact('classroomSchoolYears', 'classroomStudents'));
    }

    public function storeStudentUploadForm(Request $request)
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

    public function showTeacherAssignmentForm()
    {
        // Fetch Classroom-School Years ordered by ID
        $classroomSchoolYears = ClassroomSchoolYear::with('classroom')
            ->orderBy('id')  // Changed from orderBy('school_year') to orderBy('id')
            ->get();

        $teachers = Teacher::with('user')->orderBy('id')->get();

        // Get selected classroom or default to first one
        $selectedClassroomId = request('classroom_school_year_id', $classroomSchoolYears->first()->id ?? null);

        // Get classroom ID from the selected classroom-school year
        $classroomId = null;
        $subjects = collect();
        $existingAssignments = [];

        if ($selectedClassroomId) {
            $classroomSchoolYear = ClassroomSchoolYear::with('classroom')->find($selectedClassroomId);
            $classroomId = $classroomSchoolYear->classroom_id;

            // Get subjects for this classroom ordered by ID
            $subjects = Subject::where('classroom_id', $classroomId)
                ->orderBy('id')
                ->get();

            // Get existing assignments grouped by subject ID
            $existingAssignments = ClassroomSubject::with(['teacherAssignments' => function($query) {
                $query->with('teacher.user');
            }])
                ->where('classroom_school_year_id', $selectedClassroomId)
                ->get()
                ->mapWithKeys(function ($item) {
                    return [
                        $item->subject_id => [
                            'classroom_subject_id' => $item->id,
                            'teacher_id' => $item->teacherAssignments->first()->teacher_id ?? null,
                            'teacher_name' => $item->teacherAssignments->first()->teacher->user->name ?? null
                        ]
                    ];
                });
        }

        return view('admin.upload.subject-teacher-assignments', compact(
            'classroomSchoolYears',
            'subjects',
            'teachers',
            'selectedClassroomId',
            'existingAssignments'
        ));
    }

    public function storeTeacherAssignmentForm(Request $request)
    {
        $request->validate([
            'classroom_school_year_id' => 'required|exists:classroom_school_year,id',
            'subjects' => 'required|array',
            'subjects.*.teacher_id' => 'nullable|exists:teachers,id'
        ]);

        // Get classroom ID to verify subjects belong to this classroom
        $classroomSchoolYear = ClassroomSchoolYear::find($request->classroom_school_year_id);
        $classroomId = $classroomSchoolYear->classroom_id;

        DB::transaction(function () use ($request, $classroomId) {
            foreach ($request->subjects as $subjectId => $data) {
                // Verify subject belongs to this classroom
                $subject = Subject::where('id', $subjectId)
                    ->where('classroom_id', $classroomId)
                    ->first();

                if (!$subject) continue;

                // Update or create classroom_subject record
                $classroomSubject = ClassroomSubject::updateOrCreate(
                    [
                        'classroom_school_year_id' => $request->classroom_school_year_id,
                        'subject_id' => $subjectId,
                    ]
                );

                // Handle teacher assignment
                if (!empty($data['teacher_id'])) {
                    TeacherSubjectAssignment::updateOrCreate(
                        ['classroom_subject_id' => $classroomSubject->id],
                        ['teacher_id' => $data['teacher_id']]
                    );
                } else {
                    // Remove assignment if no teacher selected
                    TeacherSubjectAssignment::where('classroom_subject_id', $classroomSubject->id)->delete();
                }
            }
        });

        return redirect()
            ->route('admin.subjectTeacherAssignments.index', [
                'classroom_school_year_id' => $request->classroom_school_year_id
            ])
            ->with('success', 'Assignments updated successfully');
    }
}
