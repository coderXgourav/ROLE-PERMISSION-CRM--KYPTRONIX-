<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\UserController;
Route::get('/customer/login',function(){
    return view('user.index');
});

Route::post('/user-login',[UserController::class,'login']);
Route::get('user/logout',[UserController::class,'logout'])->name('user-logout');
Route::get('/customer/dashboard',[UserController::class,'customerDashboard']);
Route::post('/user/file-upload',[UserController::class,'fileUpload'])->name('file-upload');
