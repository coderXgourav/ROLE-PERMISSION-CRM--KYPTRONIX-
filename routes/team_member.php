<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;

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

Route::get('/member',function(){
    return view('team_member.index');
});
Route::post('/member-login',[MemberController::class,'login']);

// THIS IS PROTECTED ROUTE FOR TEAM MEMBERS
Route::group(['middleware'=>['member']],function(){
Route::get('/member/dashboard',[MemberController::class,'dashboard'])->name('member-dashboard');
Route::get('/member/update-credintials',[MemberController::class,'changeUsernamePage'])->name('member.change_username');
Route::get('/member/password-change',[MemberController::class,'chnagePasswordPage'])->name('member.change-password');
Route::post('/member/change_password',[MemberController::class,'changePassword']);
Route::get('member/logout',[MemberController::class,'logout'])->name('member-logout');
Route::get('/member/add-customer',[MemberController::class,'addCustomer'])->name('member.add-customer');
Route::post('/member/create_customer',[MemberController::class,'customerAdd']);
Route::get('/member/customer',[MemberController::class,'myCustomer'])->name('member.customer');
Route::post('/member/change_username',[MemberController::class,'changeUsername']);
Route::get('/member/send-email/{id}',[MemberController::class,'emailText'])->name('member.send-email');
Route::post('/member/send-email',[MemberController::class,'emailSendToClient']);

Route::get('/member/send-message/{id}',[MemberController::class,'messageText'])->name('member.send-message');
Route::get('/member/call/{id}',[MemberController::class,'callPage'])->name('member.call');

Route::post('/member/send-message',[MemberController::class,'sendSms']);
Route::get('/member/send-emails',[MemberController::class,'myEmail'])->name('member.email');
Route::get('/member/email-show/{id}',[MemberController::class,'emailShow'])->name('member.emailshow');
Route::get('/member/sms',[MemberController::class,'smsPage'])->name('member.sms');
Route::get('/member/message-show/{id}',[MemberController::class,'smsShow'])->name('member.smsShow');
Route::post('/member/remarks',[MemberController::class,'remarks']);
Route::get('/member/chat/{id}',[MemberController::class,'chatShow'])->name('member.chat');
Route::get('/member/invoice',[MemberController::class,'invoice'])->name('member.invoice');
Route::get('/member/invoice2/{id}/{invoice_id}',[MemberController::class,'invoice2'])->name('member.invoice2');

Route::get('/member/invoices/{id}',[MemberController::class,'showInvoices'])->name('member.invoices');
Route::get('/member/create-invoice/{id}',[MemberController::class,'createInvoice'])->name('member.create-invoice');
Route::post('/member/save_invoice',[MemberController::class,'invoiceAdd']);
Route::get('/member/convert_to_client',[MemberController::class,'convertToClient']);

Route::get('/member/view_clients',[MemberController::class,'viewClients'])->name('member.view_clients');

});