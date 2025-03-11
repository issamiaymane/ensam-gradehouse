<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function create()
    {
        // Load teachers with their associated user data
        $teachers = Teacher::with('user')->get();

        return view('admin.users.teacher', compact('teachers'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|max:20',
            'department' => 'required|string|max:255',
        ]);

        try {
            // Create the user first
            $user = new User();
            $user->first_name = trim($request->first_name);
            $user->last_name = trim($request->last_name);
            $user->email = trim($request->email);
            $user->password = Hash::make($request->password);
            $user->role = "teacher";
            $user->save();

            // Now create the teacher linked to the user
            $admin = new Teacher();
            $admin->user_id = $user->id;
            $admin->phone = trim($request->phone);
            $admin->department = trim($request->department);
            $admin->save();

            return redirect()->route('teacher.create')->with('success', 'Teacher added successfully!');
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->route('teacher.create')->with('error', 'An error occurred while adding the teacher: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        // Find the admin by ID
        $admin = Teacher::findOrFail($id);

        // Get the associated user
        $user = $admin->user;

        // Delete the admin first
        $admin->delete();

        // Delete the associated user
        if ($user) {
            $user->delete();
        }

        // Redirect back with a success message
        return redirect()->route('teacher.create')->with('success', 'Admin deleted successfully!');
    }

}
