<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\StudentController;
use App\Http\Controllers\Frontend\TeacherController;

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::match(['get','post'],'/student/login',[HomeController::class, 'studentLogin'])->name('student.login')/*->middleware('is_student');*/;
Route::match(['get','post'],'/teacher/login',[HomeController::class, 'teacherLogin'])->name('teacher.login');

Route::group(['prefix' => 'student', 'middleware' => 'is_student'], function (){

    Route::post('/logout', [HomeController::class, 'studentLogout'])->name('student.logout');
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
});

Route::group(['prefix' => 'teacher', 'middleware' => 'is_teacher'], function (){

    Route::post('/logout', [HomeController::class, 'teacherLogout'])->name('teacher.logout');
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
});
