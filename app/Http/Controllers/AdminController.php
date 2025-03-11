<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function create()
    {
        // Load admins with their associated user data
        $admins = Admin::with('user')->get();

        return view('admin.users.admin', compact('admins'));
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

    public function delete($id)
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

}
