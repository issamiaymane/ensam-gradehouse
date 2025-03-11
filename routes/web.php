<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
});

Route::get('profile', function () {
    return view('layouts.profile');
});

Route::get('sign-in', [AuthController::class, 'login']);
Route::post('sign-in', [AuthController::class, 'AuthLogin']);

Route::get('logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'admin'], function () {
    // Admin Dashboard routes
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/users/admin', [AdminController::class, 'create'])->name('admin.create');
    Route::post('admin/users/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::delete('admin/users/admin/{id}', [AdminController::class, 'delete'])->name('admin.delete');
    Route::get('admin/majors', [MajorController::class, 'create'])->name('major.create');
    Route::post('admin/majors', [MajorController::class, 'store'])->name('major.store');
    Route::delete('admin/majors/{id}', [MajorController::class, 'delete'])->name('major.delete');
    Route::get('admin/classrooms', [ClassroomController::class, 'create'])->name('classroom.create');
    Route::post('admin/classrooms', [ClassroomController::class, 'store'])->name('classroom.store');
    Route::delete('admin/classrooms/{id}', [ClassroomController::class, 'delete'])->name('classroom.delete');



    // Teacher Dashboard routes
    Route::get('admin/users/teacher', function () {
        return view('admin.users.teacher');
    });
    Route::get('admin/users/teacher', [TeacherController::class, 'create'])->name('teacher.create');
    Route::post('teacher/users/teacher', [TeacherController::class, 'store'])->name('teacher.store');
    Route::delete('admin/users/teacher/{id}', [TeacherController::class, 'delete'])->name('teacher.delete');

    // Student Dashboard routes
    Route::get('admin/users/student', function () {
        return view('admin.users.student');
    });
    Route::get('admin/users/student', [StudentController::class, 'create'])->name('student.create');
    Route::post('admin/users/student', [StudentController::class, 'store'])->name('student.store');
    Route::delete('admin/users/student/{id}', [StudentController::class, 'delete'])->name('student.delete');


});

Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/dashboard', function () {
        return view('teacher.dashboard');
    });
    Route::get('teacher/calendar', function () {
        return view('teacher.calendar');
    });
});

Route::group(['middleware' => 'student'], function () {
    Route::get('student/dashboard', function () {
        return view('student.dashboard');
    });
    Route::get('student/calendar', function () {
        return view('student.calendar');
    });
});


