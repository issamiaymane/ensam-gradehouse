<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ensure the authenticated user is an admin
        $user = Auth::user();

        if ($user->role !== 'admin') {
            return redirect()->route('home')->with('error', 'You do not have access to the admin dashboard.');
        }

        // Calculate total students in the system
        $totalStudents = Student::count();

        // Calculate total teachers in the system
        $totalTeachers = Teacher::count();

        // Calculate total classrooms in the system
        $totalClassrooms = Classroom::count();

        // Calculate average grade across all students
        $averageGrade = Grade::where('status', 'approved')->avg('grade') ?? 0;

        // Calculate percentage change in total students (example: compare with previous year)
        $previousTotalStudents = User::where('role', 'admin')
            ->where('created_at', '<', now()->subYear())
            ->count();
        $percentageChange = $previousTotalStudents > 0
            ? (($totalStudents - $previousTotalStudents) / $previousTotalStudents) * 100
            : 0;

        // Pass the data to the view
        return view('admin.dashboard', [
            'totalStudents' => $totalStudents,
            'totalTeachers' => $totalTeachers,
            'totalClassrooms' => $totalClassrooms,
            'averageGrade' => $averageGrade,
            'percentageChange' => $percentageChange,
        ]);
    }
}
