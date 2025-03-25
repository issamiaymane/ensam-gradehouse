<?php

namespace App\Http\Controllers;

use App\Models\ClassroomStudent;
use App\Models\ClassroomSubject;
use App\Models\Grade;
use App\Models\TeacherSubjectAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            $existingGrade = Grade::where('student_id', $studentId)
                ->where('teacher_subject_assignment_id', $classroomSubjectId)
                ->first();

            if ($existingGrade && in_array($existingGrade->status, ['submitted', 'approved', 'rejected'])) {
                return redirect()->back()->with('error', 'Cannot save. Already sent for approval or rejected.');
            }

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

        return redirect()->back()->with('success', 'Grades saved successfully!');
    }

    public function submitGrades(Request $request)
    {
        $classroomSubjectId = $request->input('classroom_subject_id');
        $students = $request->input('students');

        foreach ($students as $studentData) {
            if (empty($studentData['grade'])) {
                return redirect()->back()->with('error', 'All grades must be entered before submitting.');
            }
        }

        foreach ($students as $studentData) {
            $studentId = $studentData['student_id'];
            $grade = $studentData['grade'];

            $existingGrade = Grade::where('student_id', $studentId)
                ->where('teacher_subject_assignment_id', $classroomSubjectId)
                ->first();

            if ($existingGrade && in_array($existingGrade->status, ['submitted', 'approved', 'rejected'])) {
                return redirect()->back()->with('error', 'Cannot submit. Already sent for approval or rejected.');
            }

            Grade::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'teacher_subject_assignment_id' => $classroomSubjectId,
                ],
                [
                    'grade' => $grade,
                    'status' => 'submitted',
                ]
            );
        }

        return redirect()->back()->with('success', 'Grades submitted successfully!');
    }
}
