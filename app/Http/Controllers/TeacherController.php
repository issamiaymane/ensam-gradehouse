<?php

namespace App\Http\Controllers;

use App\Models\ClassroomStudent;
use App\Models\ClassroomSubject;
use App\Models\TeacherSubjectAssignment;
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
}
