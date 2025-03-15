<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //Admin
    public function createAdmin()
    {
        // Load admins with their associated user data
        $admins = Admin::with('user')->get();

        return view('admin.users.admin', compact('admins'));
    }

    public function storeAdmin(Request $request)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|max:20',
            'service' => 'required|string|max:255',
        ]);

        try {
            // Create the user first
            $user = new User();
            $user->first_name = trim($request->first_name);
            $user->last_name = trim($request->last_name);
            $user->email = trim($request->email);
            $user->password = Hash::make($request->password);
            $user->role = "admin";
            $user->save();

            // Now create the admin linked to the user
            $admin = new Admin();
            $admin->user_id = $user->id; // Link the admin to the created user
            $admin->phone = trim($request->phone);
            $admin->service = trim($request->service);
            $admin->save();

            return redirect()->route('admin.create')->with('success', 'Admin added successfully!');
        }
        catch (\Exception $e) {
            // Handle the error
            return redirect()->route('teacher.create')->with('error', 'An error occurred while adding the teacher: ' . $e->getMessage());
        }
    }

    public function deleteAdmin($id)
    {
        // Find the admin by ID
        $admin = Admin::findOrFail($id);

        // Get the associated user
        $user = $admin->user;

        // Delete the admin first
        $admin->delete();

        // Delete the associated user
        if ($user) {
            $user->delete();
        }

        // Redirect back with a success message
        return redirect()->route('admin.create')->with('success', 'Admin deleted successfully!');
    }

    //Teacher
    public function createTeacher()
    {
        // Load teachers with their associated user data
        $teachers = Teacher::with('user')->get();

        return view('admin.users.teacher', compact('teachers'));
    }

    public function storeTeacher(Request $request)
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

    public function deleteTeacher($id)
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

    //Student
    public function createStudent()
    {
        // Load students with their associated user data
        $students = Student::with('user')->get();

        return view('admin.users.student', compact('students'));
    }

    public function storeStudent(Request $request)
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

    public function deleteStudent($id)
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
