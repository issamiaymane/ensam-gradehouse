<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminApproval;
use App\Models\ClassroomSchoolYear;
use App\Models\ClassroomSubject;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $classroomSchoolYears = ClassroomSchoolYear::with(['classroom.major', 'classroom'])
            ->get();

        return view('admin.grades.index', compact('classroomSchoolYears'));
    }
    public function subjects($classroomSchoolYearId)
    {
        $classroomSchoolYear = ClassroomSchoolYear::with(['classroom.major', 'classroomSubjects.subject'])
            ->findOrFail($classroomSchoolYearId);

        return view('admin.grades.subjects', compact('classroomSchoolYear'));
    }

    public function grades($classroomSchoolYearId, $classroomSubjectId)
    {
        // Fetch the classroom subject with its grades and related data
        $classroomSubject = ClassroomSubject::with([
            'classroomSchoolYear.classroom.major',
            'grades.student',
            'grades.adminApprovals', // Eager load admin approvals
        ])->findOrFail($classroomSubjectId);

        return view('admin.grades.grades', compact('classroomSubject'));
    }

    public function approveGrades(Request $request, $classroomSchoolYearId, $classroomSubjectId)
    {
        // Find the classroom subject
        $classroomSubject = ClassroomSubject::findOrFail($classroomSubjectId);

        // Update all grades for this classroom_subject to 'approved'
        $grades = Grade::where('teacher_subject_assignment_id', $classroomSubject->id)
            ->where('status', 'submitted')
            ->get();

        foreach ($grades as $grade) {
            // Update the grade status
            $grade->update(['status' => 'approved']);

            // Create an admin approval record
            AdminApproval::create([
                'grade_id' => $grade->id,
                'admin_id' => auth()->id(), // Assuming the admin is logged in
                'status' => 'approved',
                'comment' => 'Grades approved.',
                'reviewed_at' => now(),
            ]);
        }

        return redirect()->route('admin.classrooms.subjects.grades', [$classroomSchoolYearId, $classroomSubjectId])
            ->with('success', 'Grades approved successfully.');
    }

    public function rejectGrades(Request $request, $classroomSchoolYearId, $classroomSubjectId)
    {
        // Find the classroom subject
        $classroomSubject = ClassroomSubject::findOrFail($classroomSubjectId);

        // Update all grades for this classroom_subject to 'rejected'
        $grades = Grade::where('teacher_subject_assignment_id', $classroomSubject->id)
            ->where('status', 'submitted')
            ->get();

        foreach ($grades as $grade) {
            // Update the grade status
            $grade->update(['status' => 'rejected']);

            // Create an admin approval record
            AdminApproval::create([
                'grade_id' => $grade->id,
                'admin_id' => auth()->id(), // Assuming the admin is logged in
                'status' => 'rejected',
                'comment' => 'Grades rejected.',
                'reviewed_at' => now(),
            ]);
        }

        return redirect()->route('admin.classrooms.subjects.grades', [$classroomSchoolYearId, $classroomSubjectId])
            ->with('success', 'Grades rejected successfully.');
    }
}
