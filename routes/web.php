<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
});

Route::get('sign-in', [AuthController::class, 'login']);
Route::post('sign-in', [AuthController::class, 'AuthLogin']);

Route::get('sign-up', [AuthController::class, 'register']);
Route::post('sign-up', [AuthController::class, 'AuthRegister']);

Route::get('logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('admin/list', function () {
        return view('admin.list');
    });
});

Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/dashboard', function () {
        return view('teacher.dashboard');
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



