<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use DB;

class GradeController extends Controller
{
    /**
     * Display submitted grades for admin approval.
     */
    public function index()
    {
        // Fetch submitted grades from the database
        $grades = DB::table('admin_grades_view')->get();

        return view('admin.grades.index', compact('grades'));
    }

    /**
     * Approve a grade.
     */
    public function approve($id)
    {
        $grade = Grade::findOrFail($id);
        $grade->update(['status' => 'approved']);

        return redirect()->route('admin.grades.index')->with('success', 'Grade approved successfully.');
    }

    /**
     * Reject a grade.
     */
    public function reject($id)
    {
        $grade = Grade::findOrFail($id);
        $grade->update(['status' => 'draft']);

        return redirect()->route('admin.grades.index')->with('success', 'Grade rejected successfully.');
    }
}
