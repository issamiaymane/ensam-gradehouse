<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Major; // Import the Major model
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    // Show the form for creating a new classroom
    public function create()
    {
        // Retrieve all classrooms and eager load the major relationship
        $classrooms = Classroom::with('major')->get();

        // Fetch all majors
        $majors = Major::all();

        // Pass both classrooms and majors to the view
        return view('admin.classrooms.classrooms', compact('classrooms', 'majors'));
    }


    // Store a newly created classroom in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'major_id' => 'required|exists:majors,id',  // Make sure the major_id exists in the majors table
            'level_year' => 'required|in:first,second,third',  // Validate the level_year
            'school_year' => 'required|string|max:255',  // Validate the school year
        ]);

        try {
            // Create the classroom in the database
            Classroom::create([
                'major_id' => $request->major_id,
                'level_year' => $request->level_year,
                'school_year' => $request->school_year,
            ]);

            // Redirect back to the classrooms list or another page
            return redirect()->route('classroom.create')->with('success', 'Classroom created successfully!');
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->route('classroom.create')->with('error', 'An error occurred while adding the classroom: ' . $e->getMessage());
        }
    }

    // Delete a specific classroom
    public function delete($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();

        // Redirect back with a success message
        return redirect()->route('classroom.create')->with('success', 'Classroom deleted successfully!');
    }
}
