<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;
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

Route::get('/', function () {
    return view('welcome');
});

//To add file
Route::get('/upload-file', [FileUploadController::class, 'createForm']);
Route::post('/upload-file', [FileUploadController::class, 'fileUpload'])->name('fileUpload');

//To update file or change file
Route::get('/edit/{id}', [FileUploadController::class, 'update']);
Route::post('/update/{id}', [FileUploadController::class, 'updateForm'])->name('update');

//list page 
Route::get('/list', [FileUploadController::class,'list']);


Route::post('/delete/{id}', [FileUploadController::class, 'delete']);
