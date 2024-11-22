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
            'admin.add-contact' =>($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" && $admin_data->user_registration_permission)?1:0,
            'admin.addContact' => $admin_data->user_registration_permission,
            'admin.updateContact' => $admin_data->user_registration_permission,
            'admin.deleteContact' => $admin_data->user_registration_permission,
            'admin.customer' => $admin_data->customer_permission,
            'admin.assign' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" && $admin_data->lead_assign_permission || $admin_data->user_type=="team_manager" && $admin_data->lead_assign_permission)?1:0,
            'admin.noneassign' => $admin_data->lead_assign_permission,
            'admin.email' => $admin_data->email_sms_permission,
            'admin.emailshow' => $admin_data->email_sms_permission,
            'admin.export' => $admin_data->report_permission,
            'admin.import' => $admin_data->report_permission,
            'admin.sms' => $admin_data->email_sms_permission,
            'admin.smsShow' => $admin_data->email_sms_permission,
            'admin.add-service' => $admin_data->service_permission,
            'admin.all-service' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" && $admin_data->service_permission>0)?1:0, 
            'admin.edit-service' => $admin_data->service_permission,
            'admin.edit' => $admin_data->user_registration_permission,
            'admin.invoice_list' => $admin_data->invoice_permission,
            'admin.view_invoice_per_customer' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_team_member' => $admin_data->invoice_permission,
            'admin.show-clients-list' => $admin_data->customer_permission,
            'admin.view_member' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" || $admin_data->user_type=="team_manager")?1:0,
            'admin.memberInvoiceList' => $admin_data->invoice_permission,
            'admin.view-service' =>  ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager")?1:0,
            'admin.team-member' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" || $admin_data->user_type=="team_manager")?1:0,
            'admin.show-leads-list' => $admin_data->leads_permission,
            'admin.service_invoices' => $admin_data->service_permission,
            'admin.view-customers' => $admin_data->customer_permission,
            'admin.manager_convert_to_clients' =>  ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" || $admin_data->user_type=="team_manager")?1:0,
            'admin.member_convert_to_client' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" || $admin_data->user_type=="team_manager")?1:0,
            'admin.view_manager_details' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager")?1:0,
            'admin.view-members' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" || $admin_data->user_type=="team_manager")?1:0,
            'admin.view-operation-managers' =>($admin_data->user_type=="admin")?1:0,
            'admin.add-lead' => $admin_data->leads_permission,
            'admin.view-lead' => $admin_data->leads_permission,
            'admin.chat' => 1,
            'admin.remarks' => 1,
            'admin.call' => $admin_data->communication_permission,
            'admin.send-email' => $admin_data->email_sms_permission,
            'admin.send-message' => $admin_data->email_sms_permission,
            'admin.create-invoice' => $admin_data->invoice_permission,
            'admin.invoice2' => $admin_data->invoice_permission,
            'admin.success-payments'=>$admin_data->payment_permission,
            'admin.failed-payments'=>$admin_data->payment_permission,
            'admin.view_clients' => $admin_data->customer_permission,
            'admin.view-invoice' => $admin_data->invoice_permission,
            'admin.show_invoice' => $admin_data->invoice_permission,
            'admin.contact' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" || $admin_data->user_type=="team_manager")?1:0,
            'admin.add-package' => $admin_data->package_permission,
            'admin.all-package' => $admin_data->package_permission,
            'admin.edit-package' => $admin_data->package_permission,
            'admin.view_assign_client' => $admin_data->lead_assign_permission,
            'admin.team-manager-list' => ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" )?1:0,
            'admin.leads-view' => $admin_data->leads_permission,
            'admin.all-reports' =>($admin_data->user_type=="admin"  )?1:0 ,
            'admin-logout' => 1,
            'not-access'=>1,
            'admin-dashboard'=>1,
            'fallback'=>1,
            'admin.get_service_based_member'=>1,
            'admin.loginHistory'=>($admin_data->user_type=="admin")?1:0,
            'admin.show-team-member-list'=> ($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" || $admin_data->user_type=="team_manager")?1:0,
            'admin.invoice-send-email'=>1,
            'admin.get_package'=>1,
            'admin.show-invoice'=>1,
            'admin.add-package'=>1,
            'admin.all-package'=>1,
            'admin.document'=>1,
            'admin.sub-service-list'=>1,
            'admin.import-leads'=>($admin_data->user_type=="admin"  || $admin_data->user_type=="operation_manager" || $admin_data->user_type=="team_manager")?1:0,
            'change_status'=>1,
            'admin.login-list'=>1,
            'admin.subservices'=>1,
            'admin.package_subservices'=>1,
            'admin.service_filter'=>1,
            'admin.add-role'=>1,
            'admin.all-role'=>1,
            'admin.edit-role'=>1,
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