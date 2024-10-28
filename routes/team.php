<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamController;

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

Route::get('/team',function(){
    return view('team.index');
});
Route::post('/team-login',[TeamController::class,'login']);

// THIS IS PROTECTED ROUTE FOR TEAM MEMBERS
Route::group(['middleware'=>['team']],function(){
Route::get('/team/dashboard',[TeamController::class,'dashboard'])->name('team-dashboard');
Route::get('/team/update-credintials',[TeamController::class,'changeUsernamePage'])->name('team.change_username');
Route::get('/team/password-change',[TeamController::class,'chnagePasswordPage'])->name('team.change-password');
Route::post('/team/change_password',[TeamController::class,'changePassword']);
Route::get('team/logout',[TeamController::class,'logout'])->name('team-logout');
Route::get('/team/add-customer',[TeamController::class,'addCustomer'])->name('team.add-customer');
Route::post('/team/create_customer',[TeamController::class,'customerAdd']);
Route::get('/team/customer',[TeamController::class,'myCustomer'])->name('team.customer');

Route::get('/team/chat/{id}',[TeamController::class,'chatShow'])->name('team.chat');


Route::post('/team/change_username',[TeamController::class,'changeUsername']);
Route::get('/team/send-email/{id}',[TeamController::class,'emailText'])->name('team.send-email');
Route::post('/team/send-email',[TeamController::class,'emailSendToClient']);

Route::get('/team/send-message/{id}',[TeamController::class,'messageText'])->name('team.send-message');
Route::get('/team/call/{id}',[TeamController::class,'callPage'])->name('team.call');

Route::post('/team/send-message',[TeamController::class,'sendSms']);
Route::get('/team/send-emails',[TeamController::class,'myEmail'])->name('team.email');
Route::get('/team/email-show/{id}',[TeamController::class,'emailShow'])->name('team.emailshow');
Route::get('/team/sms',[TeamController::class,'smsPage'])->name('team.sms');
Route::get('/team/message-show/{id}',[TeamController::class,'smsShow'])->name('team.smsShow');

Route::get('/team/team-member-add',[TeamController::class,'teamMemberAdd'])->name('team.team-member-add');
Route::post('/team/create_team_members',[TeamController::class,'create_team_members']);
Route::get('/team/team-member-lists',[TeamController::class,'teammembersLists'])->name('team.team-member-lists');
Route::get('/team/team_member_delete',[TeamController::class,'team_member_delete']);
Route::get('team/edit-team-member/{id}',[TeamController::class,'editTeamMember'])->name('team.edit-team-member');
Route::post('/team/update_members',[TeamController::class,'updateMembers']);


Route::get('/team/none_assign_clients',[TeamController::class,'noneAssginClients'])->name('team.none_assign');
Route::post('/team/assign',[TeamController::class,'assign']);
Route::get('/team/assign_clients',[TeamController::class,'assginClients'])->name('team.assign_clients');
Route::get('/team/chat/{id}',[TeamController::class,'chatShow'])->name('team.chat');
Route::get('/team/email-template',[TeamController::class,'emailTemplate'])->name('team.email-template');
Route::post('/team/send-email-template',[TeamController::class,'sendEmailTemplate']);
Route::get('/team/view-mail-template',[TeamController::class,'allEmailTemplate'])->name('team.view-mail-template');
Route::get('/team/email_template_show/{id}',[TeamController::class,'emailTemplateShow'])->name('team.email_template_show');
Route::post('/team/remarks',[TeamController::class,'remarks']);

Route::get('/team/view-team-member/{id}',[TeamController::class,'viewTeamMember'])->name('team.view-team-member');

Route::get('/team/edit-template/{id}',[TeamController::class,'editEmailTemplate'])->name('team.edit-template');
Route::post('/team/update_email_template',[TeamController::class,'updateEmailTemplate']);

Route::get('/team/view-invoice',[TeamController::class,'invoiceList'])->name('team.view-invoice');
Route::get('/team/view_invoice/{id}/{invoice_id}',[TeamController::class,'viewInvoice'])->name('team.view_invoice');
Route::get('/team/assign-client-list/{id}',[TeamController::class,'assignClientList'])->name('team.assign-client-list');
Route::get('/team/invoice-list/{id}',[TeamController::class,'invoices'])->name('team.invoice-list');
Route::get('/team/invoice/{id}/{invoice_id}',[TeamController::class,'invoiceShow'])->name('team.invoice');

Route::get('/team/invoice/{id}',[TeamController::class,'showInvoices'])->name('team.invoices');
Route::get('/team/create-invoice/{id}',[TeamController::class,'createInvoice'])->name('team.create-invoice');
Route::post('/team/save_invoice',[TeamController::class,'invoiceAdd']);
Route::get('/team/invoice2/{id}/{invoice_id}',[TeamController::class,'invoice2'])->name('team.invoice2');
Route::get('/team/convert_to_client',[TeamController::class,'convertToClient']);
Route::get('/team/view_clients',[TeamController::class,'viewClients'])->name('team.view_clients');
Route::get('/team/convert-to-client-list/{id}',[TeamController::class,'convert_to_client_list'])->name('team.convert-to-client-list');
});
 

// Route::get('/sms',[TeamController::class,'sendSms']);
Route::get('/call',[TeamController::class,'makeCall']);
Route::get('/twilio/voice', [TeamController::class, 'handleVoice']); 