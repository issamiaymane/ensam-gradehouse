<?php

namespace App\Http\Controllers;

use App\Models\Subject;

use App\Models\Classroom;
use App\Models\ClassroomSubject;
use App\Models\ClassroomSchoolYear;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Link Classroom to School Year
    public function linkClassroomToSchoolYear() {
        $classrooms = Classroom::all();
        $classroomSchoolYears = ClassroomSchoolYear::with('classroom')->get();
        return view('admin.classrooms.classroom_school_year', compact('classrooms', 'classroomSchoolYears'));
    }

    public function storeClassroomSchoolYear(Request $request) {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'school_year' => 'required|string',
        ]);

        ClassroomSchoolYear::create([
            'classroom_id' => $request->classroom_id,
            'school_year' => $request->school_year,
        ]);

        return redirect()->route('admin.linkClassroomToSchoolYear')->with('success', 'Classroom linked to school year successfully.');
    }

    public function deleteClassroomSchoolYear($id) {
        ClassroomSchoolYear::findOrFail($id)->delete();
        return redirect()->route('admin.linkClassroomToSchoolYear')->with('success', 'Link deleted successfully.');
    }

    // Assign Subjects to Classroom
    public function assignSubjectToClassroom() {

        $classroomSchoolYears = ClassroomSchoolYear::with('classroom')->get();
        $subjects = Subject::all();
        $classroomSubjects = ClassroomSubject::with(['classroomSchoolYear.classroom', 'subject'])->get();
        return view('admin.classrooms.classroom_subject', compact('classroomSchoolYears', 'subjects', 'classroomSubjects'));
    }

    public function storeClassroomSubject(Request $request) {
        $request->validate([
            'classroom_school_year_id' => 'required|exists:classroom_school_year,id',
            'subject_id' => 'required|exists:subjects,id',
            'subject_code' => 'required|string',
            'semester' => 'required|string',
        ]);

        ClassroomSubject::create([
            'classroom_school_year_id' => $request->classroom_school_year_id,
            'subject_id' => $request->subject_id,
            'subject_code' => $request->subject_code,
            'semester' => $request->semester,
        ]);

        return redirect()->route('admin.assignSubjectToClassroom')->with('success', 'Subject assigned to classroom successfully.');
    }

    public function deleteClassroomSubject($id) {
        ClassroomSubject::findOrFail($id)->delete();
        return redirect()->route('admin.assignSubjectToClassroom')->with('success', 'Assignment deleted successfully.');
    }

}
