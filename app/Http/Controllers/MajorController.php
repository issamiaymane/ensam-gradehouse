<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    // Show the form for creating a new major
    public function create()
    {
        $majors = Major::all();

        return view('admin.majors.majors', compact('majors'));
    }

    // Store a newly created major in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'code' => 'required|string|max:10|unique:majors,code',
            'name' => 'required|string|max:255',
        ]);

        try {
            // Create the major in the database
            Major::create([
                'code' => $request->code,
                'name' => $request->name,
            ]);

            // Redirect back to the majors list or another page
            return redirect()->route('major.create')->with('success', 'Major created successfully!');
        }catch (\Exception $e) {
            // Handle the error
            return redirect()->route('major.create')->with('error', 'An error occurred while adding the student: ' . $e->getMessage());
        }

    }

    // Delete a specific major
    public function delete($id)
    {
        $major = Major::findOrFail($id);
        $major->delete();

        // Redirect back with a success message
        return redirect()->route('major.create')->with('success', 'Major deleted successfully!');
    }
}

