<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function create()
    {
        // Load students with their associated user data
        $students = Student::with('user')->get();

        return view('admin.users.student', compact('students'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'apogee' => 'required|string|max:10',
        ]);

        try {
            // Create the user first
            $user = new User();
            $user->first_name = trim($request->first_name);
            $user->last_name = trim($request->last_name);
            $user->email = strtolower(trim($request->first_name)) . '_' . strtolower(trim($request->last_name)) . '@um5.ac.ma';
            $user->role = "student";
            $user->password = Hash::make($request->apogee);

            $user->save();

            // Now create the student linked to the user
            $student = new Student();
            $student->user_id = $user->id;
            $student->apogee = trim($request->apogee);
            $student->save();

            return redirect()->route('student.create')->with('success', 'Student added successfully!');
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->route('student.create')->with('error', 'An error occurred while adding the student: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        // Find the admin by ID
        $admin = Student::findOrFail($id);

        // Get the associated user
        $user = $admin->user;

        // Delete the admin first
        $admin->delete();

        // Delete the associated user
        if ($user) {
            $user->delete();
        }

        // Redirect back with a success message
        return redirect()->route('student.create')->with('success', 'Admin deleted successfully!');
    }

}
