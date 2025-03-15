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
        // Get the authenticated user
        $user = Auth::user();

        // Ensure we have the related teacher model
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('home')->with('error', 'Teacher profile not found.');
        }

        // Fetch the classroom subject
        $classroomSubject = ClassroomSubject::with(['subject', 'classroomSchoolYear.classroom'])
            ->findOrFail($classroomSubjectId);

        // Fetch students enrolled in this classroom for the school year
        $students = ClassroomStudent::where('classroom_school_year_id', $classroomSubject->classroom_school_year_id)
            ->with(['student.user', 'grades' => function ($query) use ($classroomSubjectId) {
                $query->whereHas('teacherSubjectAssignment', function ($subQuery) use ($classroomSubjectId) {
                    $subQuery->where('classroom_subject_id', $classroomSubjectId);
                });
            }])
            ->get();

        // Pass the data to the view
        return view('teacher.subject_students', compact('classroomSubject', 'students'));
    }

    public function saveGrades(Request $request)
    {
        $classroomSubjectId = $request->input('classroom_subject_id');
        $students = $request->input('students');
        $action = $request->input('action'); // 'save' or 'submit'

        foreach ($students as $studentData) {
            $studentId = $studentData['student_id'];
            $grade = $studentData['grade'];

            // Find or create the grade record
            Grade::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'teacher_subject_assignment_id' => $classroomSubjectId,
                ],
                [
                    'grade' => $grade,
                    'status' => ($action === 'submit') ? 'submitted' : 'draft', // Set status based on action
                ]
            );
        }

        return redirect()->back()->with('success', 'Grades ' . ($action === 'submit' ? 'submitted' : 'saved') . ' successfully!');
    }
}
