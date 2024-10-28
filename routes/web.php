<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
    session()->forget('team');
});
Route::get('/pay',function(){
    return view('admin.pay');
});
Route::post('/payment', [HomeController::class, 'store'])->name('payment.store');
