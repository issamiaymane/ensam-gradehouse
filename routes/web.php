<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;

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
    //Dashboard
        Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    //User Management
        //Manage Admins
        Route::get('admin/users/admin', [UserController::class, 'createAdmin'])->name('admin.create');
        Route::post('admin/users/admin', [UserController::class, 'storeAdmin'])->name('admin.store');
        Route::delete('admin/users/admin/{id}', [UserController::class, 'deleteAdmin'])->name('admin.delete');
        //Manage Students
        Route::get('admin/users/teacher', [UserController::class, 'createTeacher'])->name('teacher.create');
        Route::post('teacher/users/teacher', [UserController::class, 'storeTeacher'])->name('teacher.store');
        Route::delete('admin/users/teacher/{id}', [UserController::class, 'deleteTeacher'])->name('teacher.delete');
        //Manage Teachers
        Route::get('admin/users/student', [UserController::class, 'createStudent'])->name('student.create');
        Route::post('admin/users/student', [UserController::class, 'storeStudent'])->name('student.store');
        Route::delete('admin/users/student/{id}', [UserController::class, 'deleteStudent'])->name('student.delete');


    //Academic Management
        //Majors
        Route::get('admin/majors', [AcademicController::class, 'createMajor'])->name('major.create');
        Route::post('admin/majors', [AcademicController::class, 'storeMajor'])->name('major.store');
        Route::delete('admin/majors/{id}', [AcademicController::class, 'deleteMajor'])->name('major.delete');
        //Subjects
        Route::get('admin/subjects', [AcademicController::class, 'createSubject'])->name('subject.create');
        Route::post('admin/subjects', [AcademicController::class, 'storeSubject'])->name('subject.store');
        Route::delete('admin/subjects/{id}', [AcademicController::class, 'deleteSubject'])->name('subject.delete');
        //Classrooms
        Route::get('admin/classrooms', [AcademicController::class, 'createClassroom'])->name('classroom.create');
        Route::post('admin/classrooms', [AcademicController::class, 'storeClassroom'])->name('classroom.store');
        Route::delete('admin/classrooms/{id}', [AcademicController::class, 'deleteClassroom'])->name('classroom.delete');
            // Link Classroom to School Year
            Route::get('admin/link-classroom-to-school-year', [AdminController::class, 'linkClassroomToSchoolYear'])->name('admin.linkClassroomToSchoolYear');
            Route::post('admin/store-classroom-school-year', [AdminController::class, 'storeClassroomSchoolYear'])->name('admin.storeClassroomSchoolYear');
            Route::delete('admin/delete-classroom-school-year/{id}', [AdminController::class, 'deleteClassroomSchoolYear'])->name('admin.deleteClassroomSchoolYear');
            // Assign Subjects to Classroom
            Route::get('admin/assign-subject-to-classroom', [AdminController::class, 'assignSubjectToClassroom'])->name('admin.assignSubjectToClassroom');
            Route::post('admin/store-classroom-subject', [AdminController::class, 'storeClassroomSubject'])->name('admin.storeClassroomSubject');
            Route::delete('admin/delete-classroom-subject/{id}', [AdminController::class, 'deleteClassroomSubject'])->name('admin.deleteClassroomSubject');



    //Assignments
        // Assign Teacher to Subject
        Route::get('/admin/assignments/teacher', [AssignmentController::class, 'assignTeacherToSubject'])->name('admin.assignTeacherToSubject');
        Route::post('/admin/assignments/teacher', [AssignmentController::class, 'storeTeacherSubjectAssignment'])->name('admin.storeTeacherSubjectAssignment');
        Route::delete('/admin/assignments/teacher/{id}', [AssignmentController::class, 'deleteTeacherSubjectAssignment'])->name('admin.deleteTeacherSubjectAssignment');
        //Assign Student to Classroom;
        Route::get('admin/assignments/student', [AssignmentController::class, 'assignStudentToClassroom'])->name('admin.assignStudentToClassroom');
        Route::post('admin/assignments/student', [AssignmentController::class, 'storeClassroomStudentAssignment'])->name('admin.storeClassroomStudent');
        Route::delete('admin/assignments/student/{id}', [AssignmentController::class, 'deleteClassroomStudentAssignment'])->name('admin.deleteClassroomStudent');
});

Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/dashboard', [TeacherController::class, 'dashboard']);
    Route::get('/subject/{classroomSubjectId}/students', [TeacherController::class, 'subjectStudents'])->name('teacher.subject.students');

    Route::get('teacher/calendar', function () {
        return view('teacher.calendar');
    });
});

Route::group(['middleware' => 'student'], function () {
    Route::get('student/dashboard', [StudentController::class, 'dashboard']);
    Route::get('/classroom/{classroomSchoolYearId}/subjects', [StudentController::class, 'classroomSubjects'])->name('student.classroom.subjects');
    Route::get('student/calendar', function () {
        return view('student.calendar');
    });
});


