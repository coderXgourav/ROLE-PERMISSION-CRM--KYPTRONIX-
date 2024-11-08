<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\UserController;
Route::get('/customer/login',function(){
    return view('user.index');
})->name('upload-file');

Route::post('/user-login',[UserController::class,'login']);
Route::get('user/logout',[UserController::class,'logout'])->name('user-logout');
Route::get('/customer/dashboard',[UserController::class,'customerDashboard']);
Route::post('/file-upload',[UserController::class,'fileUpload'])->name('file-upload');
Route::get('/user/view-files',[UserController::class,'viewFiles'])->name('view-files');
Route::get('/user/view-file/{filename}',[UserController::class,'fileShow'])->name('fileShow');
