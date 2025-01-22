<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Models\Service; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,"index"]);

Route::get('/mail',function(){
    return view('admin.mail');
});
Route::post('/request',[HomeController::class,'formSubmit']);

Route::get('/all',function(){
    session()->forget('admin');
});

Route::get('/payment',[ContactController::class,'payment'])->name('payment');
Route::post('/payment', [HomeController::class, 'store'])->name('payment.store');
Route::get('/payment-success',function(){
    return view('admin.success');
});
Route::get('/payment-failed',function(){
    return view('admin.failed');
});



// USER 

Route::get('/customer/dashboard',function(){
    return view('user.dashboard.index');
});