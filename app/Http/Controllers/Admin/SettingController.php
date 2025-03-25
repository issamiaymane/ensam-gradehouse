<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\ClassroomSchoolYear;
use Illuminate\Http\Request;

class SettingController extends Controller
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

}
