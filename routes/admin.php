<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('admin.index');
});

Route::get('/admin/forgot-password',function(){
    return view('admin.forgot');
});

Route::post('/admin/reset_password',[AdminController::class,'forgotCheck'])->name('post1');
Route::post('/admin/otp_check',[AdminController::class,'otpCheck'])->name('post2');
Route::post('/admin/new_password',[AdminController::class,'newPassword'])->name('post3');
Route::post('/admin-login',[AdminController::class,'login'])->name('post4');
// THIS IS A PROTECTED ROUTES 
Route::group(['middleware' => ['admin']], function () {
   Route::get('/login/dashboard',[AdminController::class,'dashboardPage'])->name('admin-dashboard');
  Route::get('admin/password-change',[AdminController::class,'chnagePasswordPage'])->name('change-password');
Route::get('admin/logout',[AdminController::class,'logout'])->name('admin-logout');
Route::post('/admin/change_password',[AdminController::class,'changePassword'])->name('post5');

Route::get('/admin/add-contact',[AdminController::class,'addContactPage'])->name('admin.add-contact');
Route::post('/admin/create_contact',[ContactController::class,'contactAdd'])->name('admin.addContact');
// Route::get('/admin/contacts',[ContactController::class,'contactPage'])->name('admin.contact');
Route::get('/admin/change_password',[AdminController::class,'changeUsernamePage'])->name('admin.change_username');
Route::post('/admin/change_username',[AdminController::class,'changeUsername'])->name('post6');
Route::get('admin/edit/{id}',[ContactController::class,'editUserPage'])->name('admin.edit');

Route::post('/admin/update_contact',[ContactController::class,'updateContact'])->name('admin.updateContact');

Route::get('/admin/team_delete',[ContactController::class,'deleteTeam'])->name('admin.deleteContact');

Route::get('/admin/clients',[ContactController::class,'Clientspage'])->name('admin.customer');
Route::get('/admin/assign-clients',[ContactController::class,'assginClientspage'])->name('admin.assign');
Route::get('/admin/none-assign-clients',[ContactController::class,'noneAssginClientspage'])->name('admin.noneassign');
Route::post('/admin/assign',[ContactController::class,'assign'])->name('post7');
Route::post('/admin/assign_lead_to_service',[ContactController::class,'assignLeadsToService'])->name('post37');
Route::post('/admin/update-assign',[ContactController::class,'UpdateAssign'])->name('post8');
Route::get('/admin/email',[ContactController::class,'emailPage'])->name('admin.email');
Route::get('/admin/email-show/{id}',[ContactController::class,'emailShow'])->name('admin.emailshow');
Route::get('/export',[ContactController::class,'export'])->name('admin.export');
Route::get('/admin/import',[ContactController::class,'importPage'])->name('admin.import');
Route::get('/admin/import-leads',[ContactController::class,'importsLeadPage'])->name('admin.import-leads');
Route::post('/admin/upload_csv',[ContactController::class,'import'])->name('post9');
Route::post('/admin/upload_individual_csv',[ContactController::class,'individualImport'])->name('post30');
Route::get('/admin/sms',[ContactController::class,'smsPage'])->name('admin.sms');
Route::get('/admin/message-show/{id}',[ContactController::class,'smsShow'])->name('admin.smsShow');
Route::post('/admin/client_delete',[ContactController::class,'deleteClient'])->name('post10');
Route::get('/admin/add-service',[AdminController::class,'addServicePage'])->name('admin.add-service');
Route::post('/admin/add-service',[ServiceController::class,'serviceAdd'])->name('post11');
Route::get('/admin/all-service',[ServiceController::class,'allServices'])->name('admin.all-service');
Route::post('/admin/service_delete',[ServiceController::class,'service_delete'])->name('post12');
Route::get('admin/edit-service/{id}',[ServiceController::class,'editService'])->name('admin.edit-service');
Route::post('/admin/update_service',[ServiceController::class,'updateService'])->name('post13');


Route::get('/admin/add-team-member',[AdminController::class,'addTeamMember'])->name('admin.add-team-member');
Route::post('/admin/create_team_members',[ContactController::class,'create_team_members'])->name('post14');
Route::get('/admin/team-member-lists',[ContactController::class,'teammembersLists'])->name('admin.team-member-lists');
Route::get('/admin/team_member_delete',[ContactController::class,'team_member_delete']);
Route::get('admin/edit-team-member/{id}',[ContactController::class,'editTeamMember'])->name('admin.edit-team-member');
Route::post('/admin/update_members',[ContactController::class,'updateMembers'])->name('post15');


Route::get('/admin/invoice_list/{id}',[ContactController::class,'invoiceList'])->name('admin.invoice_list');
Route::get('/admin/invoice/{id}',[ContactController::class,'invoicePerCustomer'])->name('admin.view_invoice_per_customer');
Route::get('/admin/view_invoice/{id}/{invoice_id}',[ContactController::class,'viewInvoice'])->name('admin.view_invoice');
Route::get('/admin/contact/{id}',[ContactController::class,'viewTeamMember'])->name('admin.view_team_member');
Route::get('/admin/show-team-member-list/{id}',[ContactController::class,'teamMemberList'])->name('admin.show-team-member-list');
Route::get('/admin/show-clients-list/{id}',[ContactController::class,'showClientsList'])->name('admin.show-clients-list');
Route::get('admin/view_member/{id}',[ContactController::class,'viewMember'])->name('admin.view_member');
Route::get('/admin/member_invoice_list/{id}',[ContactController::class,'memberInvoiceList'])->name('admin.member_invoice_list');
Route::get('/admin/view-service/{id}',[ServiceController::class,'viewService'])->name('admin.view-service');
Route::get('/admin/team-member/{id}',[ServiceController::class,'teamMember'])->name('admin.team-member');

Route::get('/admin/show-leads-list/{id}',[ServiceController::class,'showLeadsList'])->name('admin.show-leads-list');
Route::get('/admin/service_invoices/{id}',[ServiceController::class,'serviceInvoices'])->name('admin.service_invoices');
Route::get('/admin/manager_convert_to_clients/{id}',[ContactController::class,'manager_convert_to_clients_list'])->name('admin.manager_convert_to_clients');
Route::get('/admin/member_convert_to_client/{id}',[ContactController::class,'member_convert_to_clients_list'])->name('admin.member_convert_to_client');
Route::get('admin/view-customers',[ContactController::class,'viewCustomers'])->name('admin.view-customers');
Route::get('/admin/view-managers',[ContactController::class,'viewManagers'])->name('admin.view-managers');
Route::get('/admin/view_manager_details/{id}',[ContactController::class,'viewManagerDetails'])->name('admin.view_manager_details');
Route::get('/admin/view-members',[ContactController::class,'viewMembers'])->name('admin.view-members');
Route::get('/admin/view-operation-managers',[ContactController::class,'viewOperationsManagers'])->name('admin.view-operation-managers');
Route::get('/admin/add-lead',[ContactController::class,'addLead'])->name('admin.add-lead');
Route::post('/admin/create_lead',[ContactController::class,'leadAdd'])->name('post16');
Route::get('/admin/view-lead',[ContactController::class,'viewLeads'])->name('admin.view-lead');

Route::get('/admin/chat/{id}',[ContactController::class,'chatShow'])->name('admin.chat'); 
Route::post('/admin/remarks',[ContactController::class,'remarks'])->name('admin.remarks');
Route::get('/admin/call/{id}',[ContactController::class,'callPage'])->name('admin.call');
Route::get('/admin/send-email/{id}',[ContactController::class,'emailText'])->name('admin.send-email');
Route::post('/admin/send-email',[ContactController::class,'emailSendToClient'])->name('post17');
Route::get('/admin/send-message/{id}',[ContactController::class,'messageText'])->name('admin.send-message');
Route::post('/admin/send-message',[ContactController::class,'sendSms']);
Route::get('/admin/create-invoice/{id}',[ContactController::class,'createInvoice'])->name('admin.create-invoice');
Route::post('/admin/save_invoice',[ContactController::class,'invoiceAdd'])->name('post18');
Route::get('/admin/invoice2/{id}/{invoice_id}',[ContactController::class,'invoice2'])->name('admin.invoice2');
Route::get('/admin/convert_to_client',[ContactController::class,'convertToClient']);
Route::get('/admin/view_clients',[ContactController::class,'viewClients'])->name('admin.view_clients');
Route::get('/admin/view-invoice',[ContactController::class,'viewInvoiceList'])->name('admin.view-invoice');
Route::get('/admin/show_invoice/{id}/{invoice_id}',[ContactController::class,'showInvoice'])->name('admin.show_invoice');
Route::get('/admin/email-template',[ContactController::class,'emailTemplate'])->name('admin.email-template');
Route::post('/admin/send-email-template',[ContactController::class,'sendEmailTemplate'])->name('post19');
Route::get('/admin/view-mail-template',[ContactController::class,'allEmailTemplate'])->name('admin.view-mail-template');
Route::get('/admin/contacts',[ContactController::class,'filterUsers'])->name('admin.contact');
Route::get('/admin/check-assign',[ContactController::class,'checkBeforeAssign']);
Route::get('/admin/get_service_based_member',[ContactController::class,'getServiceBasedMembers'])->name('admin.get_service_based_member');
Route::get('/admin/add-package',[AdminController::class,'addPackagePage'])->name('admin.add-package');
Route::post('/admin/save_package',[ContactController::class,'savePackage'])->name('post20');
Route::get('/admin/all-package',[AdminController::class,'allPackages'])->name('admin.all-package');

Route::get('admin/edit-package/{id}',[AdminController::class,'editPackage'])->name('admin.edit-package');
Route::post('/admin/update_package',[ContactController::class,'updatePackage'])->name('post21');
Route::post('/admin/package_delete',[ContactController::class,'deletePackage'])->name('post22');
Route::get('/admin/view_assign_client/{id}',[ContactController::class,'viewAssignClient'])->name('admin.view_assign_client');
Route::get('/admin/team-manager-list/{id}',[ServiceController::class,'teamManagerList'])->name('admin.team-manager-list');
Route::get('/admin/leads-view/{id}',[ContactController::class,'leadsView'])->name('admin.leads-view');
Route::get('/admin/get_package/{package_id}',[ContactController::class,'getPackage'])->name('admin.get_package');
Route::get('/admin/all-reports',[ContactController::class,'allReports'])->name('admin.all-reports');
Route::get('/admin/login-history',[AdminController::class,'loginHistory'])->name('admin.loginHistory');



Route::post('/admin/invoice-send-email',[ContactController::class,'emailSend'])->name('admin.invoice-send-email');
Route::get('/admin/show-invoice/{id}',[ContactController::class,'showInvoiceList'])->name('admin.show-invoice');

Route::get('/admin/success-payments',[ContactController::class,'showSuccessfullPayments'])->name('admin.success-payments');

Route::get('/admin/failed-payments',[ContactController::class,'showFailedPayments'])->name('admin.failed-payments');
Route::get('/admin/document/{id}',[ContactController::class,'documentPage'])->name('admin.document');


Route::get('/admin/view-file/{filename}',[ContactController::class,'fileShow'])->name('admin.fileShow');
Route::get('/admin/sub_service_delete',[ServiceController::class,'deleteSubService'])->name('post23');

});

Route::get('/not-access',function(){
    return view('not_access');
})->name('not-access');

Route::fallback(function () {
     return view('not_found');
})->name('fallback');





// 1345431
// indni
// ())(
// ()()