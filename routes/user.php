<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\UserController;
Route::get('/customer/login',function(){
    return view('user.index');
});

Route::post('/user-login',[UserController::class,'login']);
Route::get('/customer/dashboard',function(){
    return view('user.dashboard.index');
});
Route::get('user/logout',[UserController::class,'logout'])->name('user-logout');
