<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();

        $lastMonthStudents = Student::whereHas('user', function ($query) {
            $query->whereDate('created_at', '<', Carbon::now()->subMonth());
        })->count();

        if ($lastMonthStudents > 0) {
            $percentageChange = (($totalStudents - $lastMonthStudents) / $lastMonthStudents) * 100;
        } else {
            $percentageChange = 0; // Évite la division par zéro
        }

        return view('admin.dashboard', compact('totalStudents', 'percentageChange'));
    }
}
