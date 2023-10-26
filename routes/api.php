<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentMarksController;
use App\Http\Controllers\StudentAuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Students
Route::middleware('auth:sanctum')->group(function(){
    // Route::get('/user', function () {
        //add edit student
        Route::post('/add', [StudentController::class, 'add_student']);
        Route::post('/edit/{id}', [StudentController::class, 'edit']);
        Route::delete('/delete/{id}', [StudentController::class, 'destroy']);
        //user (teacher logout route)
        Route::get('/logout', [HomeController::class, 'logout']);
    // });


    Route::group(['prefix' => 'teacher'], function () {
        Route::post('/add', [TeacherController::class, 'add_teacher']);
        Route::post('/edit/{id}', [TeacherController::class, 'edit']);
        
        Route::get('/list', [TeacherController::class, 'list']);
        Route::delete('/delete/{id}', [TeacherController::class, 'destroy']);
    });
});

//Student

Route::group(['prefix' => 'student'], function () {
    Route::post('/register', [StudentAuthController::class, 'register']);
    Route::post('/login', [StudentAuthController::class, 'login']);
    Route::get('/export-marks', [StudentMarksController::class, 'export_marks'])->name('export_marksheet');
});



//Teacher Auth
Route::post('/register', [HomeController::class, 'register'])->name('register');

Route::post('/login', [HomeController::class, 'login']);

Route::post('/update_profile/{id}', [HomeController::class, 'update_profile']);

//Admin Principle
Route::post('/sent_otp', [AdminController::class, 'sent_otp']);
Route::post('/verify_otp', [AdminController::class, 'verify_otp']);







 


