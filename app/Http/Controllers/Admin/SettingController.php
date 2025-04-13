<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\ClassroomSchoolYear;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function linkClassroomToSchoolYear()
    {
        $classroomSchoolYears = ClassroomSchoolYear::with('classroom')
            ->orderBy('school_year', 'desc')
            ->orderBy('classroom_id')
            ->get();

        return view('admin.settings.classroom_school_year', compact('classroomSchoolYears'));
    }

    public function storeClassroomSchoolYear(Request $request)
    {
        $request->validate([
            'school_year' => 'required|string',
        ]);

        // Get all active classrooms
        $classrooms = Classroom::all();

        // Counter for successful assignments
        $assignedCount = 0;

        foreach ($classrooms as $classroom) {
            // Check if assignment already exists
            if (!ClassroomSchoolYear::where('classroom_id', $classroom->id)
                ->where('school_year', $request->school_year)
                ->exists()) {

                ClassroomSchoolYear::create([
                    'classroom_id' => $classroom->id,
                    'school_year' => $request->school_year,
                ]);

                $assignedCount++;
            }
        }

        if ($assignedCount > 0) {
            return redirect()->route('admin.linkClassroomToSchoolYear')
                ->with('success', "{$request->school_year} school year has been assigned to {$assignedCount} classrooms.");
        }

        return redirect()->route('admin.linkClassroomToSchoolYear')
            ->with('info', "All classrooms already have {$request->school_year} school year assigned.");
    }

    public function deleteClassroomSchoolYear($id)
    {
        $assignment = ClassroomSchoolYear::findOrFail($id);
        $schoolYear = $assignment->school_year;
        $classroomName = $assignment->classroom->name;

        $assignment->delete();

        return redirect()->route('admin.linkClassroomToSchoolYear')
            ->with('success', "School year {$schoolYear} has been removed from {$classroomName}.");
    }
}
