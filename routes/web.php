<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::view('/', 'auth.login');
Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    Route::view('/dashboard', 'dashboard.index');
    Route::view('/change-password', 'auth.passwords.change-password')->name('change-password');

    Route::resource('users', UserController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('departments', DepartmentController::class);
    Route::get('getPermissions', [PermissionController::class, 'getPermissions'])->name('getPermissions');
    Route::post('change-password', [UserController::class, 'changePassword'])->name('change-password');

    Route::resource('students', StudentController::class);
    Route::resource('staffs', StaffController::class);
    Route::resource('results',ResultController::class);
    Route::resource('exams', ExamController::class);
});
