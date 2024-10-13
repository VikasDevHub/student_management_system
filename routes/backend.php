<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Backend\BatchController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;

Route::get('/test', function () {
    return view('backend.layouts.main');
});

Route::get('/page-not-found',function (){
    return view('backend.error-pages.error-404');
})->name('page-not-found');

Route::prefix('admin')->group(function (){
    Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::post( '/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::resources([
        'teachers' => TeacherController::class,
        'students' => StudentController::class,
        'batch' => BatchController::class,
        'permissions' => PermissionController::class,
        'roles' => RoleController::class,
    ]);
});

