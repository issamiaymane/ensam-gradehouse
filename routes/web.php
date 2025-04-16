<?php

use App\Http\Controllers\Admin\AcademicController;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Route::get('profile', function () {
    return view('layouts.profile');
});

Route::get('sign-in', [AuthController::class, 'login']);
Route::post('sign-in', [AuthController::class, 'AuthLogin']);

Route::get('logout', [AuthController::class, 'logout']);

Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

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

    //Global Upload and Assignments
        //Upload Students
        Route::get('admin/upload/students', [UploadController::class, 'showStudentUploadForm'])->name('admin.students.upload.form');
        Route::post('admin/upload/students', [UploadController::class, 'storeStudentUploadForm'])->name('admin.students.upload');
        //Assign Teachers with Subjects
        Route::get('admin/assign/subject-teacher-assignments', [UploadController::class, 'showTeacherAssignmentForm'])->name('admin.subjectTeacherAssignments.index');
        Route::post('admin/assign/subject-teacher-assignments', [UploadController::class, 'storeTeacherAssignmentForm'])->name('admin.subjectTeacherAssignments.store');


    //Single Upload and Assignments
        // Assign Subjects to Classroom
        Route::get('admin/assignments/subject', [AssignmentController::class, 'assignSubjectToClassroom'])->name('admin.assignSubjectToClassroom');
        Route::post('admin/assignments/subject', [AssignmentController::class, 'storeSubjectClassroom'])->name('admin.storeSubjectClassroom');
        Route::delete('admin/assignments/subject/{id}', [AssignmentController::class, 'deleteSubjectClassroom'])->name('admin.deleteSubjectClassroom');
        // Assign Teacher to Subject
        Route::get('admin/assignments/teacher', [AssignmentController::class, 'assignTeacherToSubject'])->name('admin.assignTeacherToSubject');
        Route::post('admin/assignments/teacher', [AssignmentController::class, 'storeTeacherSubjectAssignment'])->name('admin.storeTeacherSubjectAssignment');
        Route::delete('admin/assignments/teacher/{id}', [AssignmentController::class, 'deleteTeacherSubjectAssignment'])->name('admin.deleteTeacherSubjectAssignment');
        //Assign Student to Classroom;
        Route::get('admin/assignments/student', [AssignmentController::class, 'assignStudentToClassroom'])->name('admin.assignStudentToClassroom');
        Route::post('admin/assignments/student', [AssignmentController::class, 'storeClassroomStudentAssignment'])->name('admin.storeClassroomStudent');
        Route::delete('admin/assignments/student/{id}', [AssignmentController::class, 'deleteClassroomStudentAssignment'])->name('admin.deleteClassroomStudent');



    ///Settings
            // Link Classroom to School Year
            Route::get('admin/settings/link-classroom-to-school-year', [SettingController::class, 'linkClassroomToSchoolYear'])->name('admin.linkClassroomToSchoolYear');
            Route::post('admin/settings/store-classroom-school-year', [SettingController::class, 'storeClassroomSchoolYear'])->name('admin.storeClassroomSchoolYear');
            Route::delete('admin/settings/delete-classroom-school-year/{id}', [SettingController::class, 'deleteClassroomSchoolYear'])->name('admin.deleteClassroomSchoolYear');
            // Students Promotion
});

Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/dashboard', [TeacherController::class, 'dashboard']);
    Route::get('teacher/subject/{classroomSubjectId}/grades', [TeacherController::class, 'subjectStudents'])->name('teacher.subject.students');
    Route::post('teacher/grades/save', [TeacherController::class, 'saveGrades'])->name('grades.save');
    Route::post('teacher/grades/submit', [TeacherController::class, 'submitGrades'])->name('grades.submit');
    Route::post('/grades/grades/export', [TeacherController::class, 'exportGrades'])->name('grades.export');

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


