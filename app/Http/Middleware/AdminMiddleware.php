<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;
use Session;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      if (Session::has('admin')) {
            $id = Session::get('admin');
            // Retrieve admin data and permissions from the database
            $admin_data = DB::table('main_user')
                ->join('permission', 'permission.user_id', 'main_user.id')
                ->where('main_user.id', $id)
                ->first();

            // Check if admin data was retrieved
            if ($admin_data) {
                // Determine the current route name
                $routeName = $request->route()->getName();

                // Check if the admin has access to the route
                if ($this->hasAccess($admin_data, $routeName)) {
                    return $next($request); // Allow access if permissions are valid
                }
            }
        }else{
            return  redirect('/login');
        }

        // Redirect if the user is not logged in or doesn't have permissions
        return redirect('/not-access')->with('error', 'Unauthorized access.');
    }

     private function hasAccess($admin_data, $routeName)
    {
        // echo "<pre>";
        // print_r($admin_data);
        // print_r($routeName);
        // die;
        // Define your permission logic based on route names


        $permissions = [
            'admin-dashboard' => 1, // Example permission key
            'change-password' => 1,
            'admin.add-contact' =>($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" && $admin_data->staff_registration)?1:0,
            'admin.addContact' => $admin_data->staff_registration,
            'admin.updateContact' => $admin_data->staff_registration,
            'admin.deleteContact' => $admin_data->staff_registration,
            'admin.customer' => $admin_data->leads_view,
            'admin.assign' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" && $admin_data->assign_manage || $admin_data->user_type=="team_manager" && $admin_data->assign_manage)?1:0,
            'admin.noneassign' => $admin_data->assign_manage,
            'admin.email' => $admin_data->email_view,
            'admin.emailshow' => $admin_data->email_view,
            'admin.export' => $admin_data->leads_import_individual,
            'admin.import' => $admin_data->leads_import_individual,
            'admin.sms' => $admin_data->sms_view,
            'admin.smsShow' => $admin_data->sms_view,
            'admin.add-service' => $admin_data->service_add,
            'admin.all-service' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" || $admin_data->user_type=="team_manager" && $admin_data->service_view>0)?1:0, 
            'admin.edit-service' => $admin_data->service_edit,
            'admin.edit' => $admin_data->staff_registration,
            'admin.invoice_list' => $admin_data->invoice_view,
            'admin.view_invoice_per_customer' => $admin_data->invoice_view,
            'admin.view_invoice' => $admin_data->invoice_view,
            'admin.view_team_member' => $admin_data->invoice_view,
            'admin.show-clients-list' => $admin_data->clients_view,
            'admin.view_member' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" || $admin_data->user_type=="team_manager")?1:0,
            'admin.memberInvoiceList' => $admin_data->invoice_view,
            'admin.view-service' =>  ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager")?1:0,
            'admin.team-member' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" || $admin_data->user_type=="team_manager")?1:0,
            'admin.show-leads-list' => $admin_data->leads_view,
            'admin.service_invoices' => $admin_data->invoice_view,
            'admin.view-customers' => $admin_data->leads_view,
            'admin.manager_convert_to_clients' =>  ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" || $admin_data->user_type=="team_manager")?1:0,
            'admin.member_convert_to_client' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" || $admin_data->user_type=="team_manager")?1:0,
            'admin.view_manager_details' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager")?1:0,
            'admin.view-members' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" || $admin_data->user_type=="team_manager")?1:0,
            'admin.view-operation-managers' =>($admin_data->user_type=="admin")?1:0,
            'admin.add-lead' => $admin_data->leads_add,
            'admin.view-lead' => $admin_data->leads_view,
            'admin.chat' => 1,
            'admin.remarks' => 1,
            'admin.call' => $admin_data->leads_view,
            'admin.send-email' => $admin_data->email_view,
            'admin.send-message' => $admin_data->sms_view,
            'admin.create-invoice' => $admin_data->invoice_view,
            'admin.invoice2' => $admin_data->invoice_view,
            'admin.success-payments'=>$admin_data->payments_successful,
            'admin.failed-payments'=>$admin_data->payments_failed,
            'admin.view_clients' => $admin_data->clients_view,
            'admin.view-invoice' => $admin_data->invoice_view,
            'admin.show_invoice' => $admin_data->invoice_view,
            'admin.contact' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" || $admin_data->user_type=="team_manager")?1:0,
            'admin.add-package' => $admin_data->package_add,
            'admin.all-package' => $admin_data->package_view,
            'admin.edit-package' => $admin_data->package_edit,
            'admin.view_assign_client' => $admin_data->assign_manage,
            'admin.team-manager-list' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" )?1:0,
            'admin.leads-view' => $admin_data->leads_view,
            'admin.all-reports' =>($admin_data->user_type=="admin" || $admin_data->user_type=="operation_manager" && $admin_data->report_count>0)?1:0 ,
            'admin.individual-report' =>($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" && $admin_data->report_individual>0)?1:0 ,
            'admin.staff-report' =>($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" && $admin_data->report_staff>0)?1:0 ,
            'admin.business-report' =>($admin_data->user_type=="admin" ||  $admin_data->user_type=="operation_manager" && $admin_data->report_business>0)?1:0 ,
            'admin-logout' => 1,
            'admin.login-times'=>1,
            'not-access'=>1,
            'admin-dashboard'=>1,
            'fallback'=>1,
            'admin.get_service_based_member'=>1,
            'admin.loginHistory'=>($admin_data->login_history_view>0)?1:0,
            'admin.show-team-member-list'=> ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" || $admin_data->user_type=="team_manager")?1:0,
            'admin.invoice-send-email'=>1,
            'admin.get_package'=>1,
            'admin.show-invoice'=>1,
            'admin.add-package'=>1,
            'admin.all-package'=>1,
            'admin.document'=>1,
            'admin.sub-service-list'=>1,
            'admin.import-leads'=>($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" || $admin_data->user_type=="team_manager")?1:0,
            'admin.show-team-manager-list'=>($admin_data->user_type=="admin")?1:0,
            'admin.operation-manger-list' => ($admin_data->user_type=="admin" || $admin_data->user_type=="operation_manager")?1:0,
            'change_status'=>1,
            'admin.login-list'=>1,
            'admin.subservices'=>1,
            'admin.package_subservices'=>1,
            'admin.service_filter'=>1,
            'admin.add-role'=>1,
            'admin.all-role'=>1,
            'admin.edit-role'=>1,
            'admin.download-pdf'=>1,
            'admin.business-report-pdf'=>1,
            'admin.package_details'=>1,
            'admin.staff-report-pdf'=>1,
            'admin.team-managers'=>1,
            // POST METHODS
            'post37'=>1,
            'post1' => 1,
            'post30' => 1,
            'post2' => 1,
            'post3' => 1,
            'post4' => 1,
            'post5' => 1,
            'post6' => 1,
            'post7' => 1,
            'post8' => 1,
            'post9' => 1,
            'post10' => 1,
            'post11' => 1,
            'post12' => 1,
            'post13' => 1,
            'post14' => 1,
            'post15' => 1,
            'post16' => 1,
            'post17' => 1,
            'post18' => 1,
            'post19' => 1,
            'post20' => 1,
            'post21' => 1,
            'post22' => 1,
            'post23' => 1,
            'post24' => 1,
            'post25' => 1,
            'post26' => 1,
            'admin.change_username'=>1,
            'admin.fileShow'=>1,
            // 'admin.payment'=>1,  
            'payment.store'=>1,
            'admin.update_service_data'=>1,

            
        ];

        // Check if the route name exists in the permissions array

         if (array_key_exists($routeName, $permissions)) {
            if($permissions[$routeName]==1){
                return true;
                echo "its accessable";
            }else{
                               return false;

            }
        }
        // Default to denying access if no specific permissions are found
        return false;
    }



    }