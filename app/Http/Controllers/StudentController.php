<?php

namespace App\Http\Controllers;

use App\Models\ClassroomSchoolYear;
use App\Models\ClassroomStudent;
use App\Models\ClassroomSubject;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    public function dashboard()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Ensure we have the related student model
        $student = $user->student;

        if (!$student) {
            return redirect()->route('home')->with('error', 'Student profile not found.');
        }

        // Fetch the student's classrooms with the necessary relationships
        $classrooms = ClassroomStudent::where('student_id', $student->id)
            ->with(['classroomSchoolYear.classroom.major', 'classroomSchoolYear'])
            ->get()
            ->groupBy('classroomSchoolYear.school_year'); // Group by school year

        // Pass the data to the view
        return view('student.dashboard', compact('classrooms'));
    }
    public function classroomSubjects($classroomSchoolYearId)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Ensure we have the related student model
        $student = $user->student;

        if (!$student) {
            return redirect()->route('home')->with('error', 'Student profile not found.');
        }

        // Fetch the classroom school year
        $classroomSchoolYear = ClassroomSchoolYear::with(['classroom.major'])
            ->findOrFail($classroomSchoolYearId);

        // Fetch subjects for this classroom with teacher and grades
        $subjects = ClassroomSubject::where('classroom_school_year_id', $classroomSchoolYearId)
            ->with(['subject', 'teacherSubjectAssignments.teacher.user', 'grades' => function ($query) use ($student) {
                $query->where('student_id', $student->id)
                    ->where('status', 'sent'); // Only fetch sent grades
            }])
            ->get();

        // Pass the data to the view
        return view('student.classroom_subjects', compact('classroomSchoolYear', 'subjects'));
    }
}
