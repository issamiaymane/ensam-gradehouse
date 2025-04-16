<?php

namespace App\Http\Controllers;

use App\Models\ClassroomStudent;
use App\Models\ClassroomSubject;
use App\Models\Grade;
use App\Models\TeacherSubjectAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;

class TeacherController extends Controller
{

    public function dashboard()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Ensure we have the related teacher model
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('home')->with('error', 'Teacher profile not found.');
        }

        // Fetch only the subjects assigned to this teacher with the necessary relationships
        $assignedSubjects = TeacherSubjectAssignment::where('teacher_id', $teacher->id)
            ->with(['classroomSubject.subject', 'classroomSubject.classroomSchoolYear']) // Load the subject and classroomSchoolYear relationships
            ->get()
            ->groupBy(function ($assignment) {
                return $assignment->classroomSubject->classroomSchoolYear->school_year; // Group by school_year
            });

        // Pass the data to the view
        return view('teacher.dashboard', compact('user', 'assignedSubjects'));
    }
    public function subjectStudents($classroomSubjectId)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('home')->with('error', 'Teacher profile not found.');
        }

        $classroomSubject = ClassroomSubject::with(['subject', 'classroomSchoolYear.classroom'])
            ->findOrFail($classroomSubjectId);

        $students = ClassroomStudent::where('classroom_school_year_id', $classroomSubject->classroom_school_year_id)
            ->with(['student.user', 'grades' => function ($query) use ($classroomSubjectId) {
                $query->whereHas('teacherSubjectAssignment', function ($subQuery) use ($classroomSubjectId) {
                    $subQuery->where('classroom_subject_id', $classroomSubjectId);
                });
            }])
            ->get();

        return view('teacher.subject_students', compact('classroomSubject', 'students'));
    }

    public function saveGrades(Request $request)
    {
        $classroomSubjectId = $request->input('classroom_subject_id');
        $students = $request->input('students');

        foreach ($students as $studentData) {
            $studentId = $studentData['student_id'];
            $grade = $studentData['grade'];

            // Handle empty grade (consider it as null)
            if ($grade === '' || $grade === null) {
                $grade = null;
            } else {
                // Validate decimal separator
                if (is_string($grade) && strpos($grade, ',') !== false) {
                    return redirect()->back()->with('error', 'Please use dot (.) as decimal separator instead of comma (,). Example: 12.5 instead of 12,5');
                } else {
                    // Convert to float if it's a valid number
                    $grade = is_numeric($grade) ? (float)$grade : null;

                    // Validate grade range (-1 to 20, where -1 means absent)
                    if ($grade !== null && ($grade < -1 || $grade > 20)) {
                        return redirect()->back()->with('error', 'Grades must be between -1 (absent) and 20.');
                    }
                }
            }

            $existingGrade = Grade::where('student_id', $studentId)
                ->where('teacher_subject_assignment_id', $classroomSubjectId)
                ->first();

            if ($existingGrade && in_array($existingGrade->status, ['sent'])) {
                return redirect()->back()->with('error', 'Cannot save, grades already sent to students. Please contact the administrator.');
            } else {
                Grade::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'teacher_subject_assignment_id' => $classroomSubjectId,
                    ],
                    [
                        'grade' => $grade,
                        'status' => 'draft',
                    ]
                );
            }
        }

        return redirect()->back()->with('warning', 'Grades saved successfully!');
    }

    public function submitGrades(Request $request)
    {
        $classroomSubjectId = $request->input('classroom_subject_id');
        $students = $request->input('students');

        foreach ($students as $studentData) {
            $grade = $studentData['grade'] ?? null;

            // Check if grade is empty (null or empty string)
            if ($grade === '' || $grade === null) {
                return redirect()->back()->with('error', 'All grades must be entered before submitting. Use -1 for absent students.');
            } else {
                // Validate decimal separator
                if (is_string($grade) && strpos($grade, ',') !== false) {
                    return redirect()->back()->with('error', 'Please use dot (.) as decimal separator instead of comma (,). Example: 12.5 instead of 12,5');
                } else {
                    // Convert to float if it's a valid number
                    $grade = is_numeric($grade) ? (float)$grade : null;

                    // Validate grade range (-1 to 20)
                    if ($grade === null || $grade < -1 || $grade > 20) {
                        return redirect()->back()->with('error', 'Grades must be between -1 (absent) and 20.');
                    }
                }
            }
        }

        foreach ($students as $studentData) {
            $studentId = $studentData['student_id'];
            $grade = $studentData['grade'];
            $grade = is_numeric($grade) ? (float)$grade : null;

            $existingGrade = Grade::where('student_id', $studentId)
                ->where('teacher_subject_assignment_id', $classroomSubjectId)
                ->first();

            if ($existingGrade && in_array($existingGrade->status, ['submitted', 'sent'])) {
                return redirect()->back()->with('error', 'Cannot submit, grades already sent to students. Please contact the administrator.');
            } else {
                Grade::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'teacher_subject_assignment_id' => $classroomSubjectId, // Fixed this line
                    ],
                    [
                        'grade' => $grade,
                        'status' => 'sent',
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Grades submitted successfully!');
    }

    public function exportGrades(Request $request)
    {
        // Get the uploaded file
        $file = $request->file('grades_excel');

        // Load the Excel file
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();

        // Get the classroom subject ID
        $classroomSubjectId = $request->input('classroom_subject_id');

        // Start reading from row 18 (as per your instructions)
        $row = 18;

        // Loop through the rows until there are no more apogees in column A
        while ($sheet->getCell('A' . $row)->getValue()) {
            // Get the apogee from column A
            $apogee = $sheet->getCell('A' . $row)->getValue();

            // Look up the student by apogee
            $student = \App\Models\Student::where('apogee', $apogee)->first();

            if ($student) {
                // Fetch the grade for this student and teacher's subject assignment
                $grade = \App\Models\Grade::where('student_id', $student->id)
                    ->where('teacher_subject_assignment_id', $classroomSubjectId)
                    ->first();

                if ($grade) {
                    // Set the grade in column E (grade column)
                    $sheet->setCellValue('E' . $row, $grade->grade);
                } else {
                    // If no grade, set a blank or a message (e.g., "No grade")
                    $sheet->setCellValue('E' . $row, 'No grade');
                }
            } else {
                // If student not found, set a message in the grade column
                $sheet->setCellValue('E' . $row, 'Student not found');
            }

            $row++; // Move to the next row
        }

        // Get the original file name
        $originalFileName = $file->getClientOriginalName();

        // Define the path where the file will be saved (use the same name as the uploaded file)
        $tempFilePath = storage_path('app/public/' . $originalFileName);

        // Save the modified spreadsheet to the temporary file
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($tempFilePath);

        // Return the file for download with the original name
        return response()->download($tempFilePath)->deleteFileAfterSend(true);
    }

}
