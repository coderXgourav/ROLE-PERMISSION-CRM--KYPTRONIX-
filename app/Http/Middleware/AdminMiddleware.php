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
        }

        // Redirect if the user is not logged in or doesn't have permissions
        return redirect('/')->with('error', 'Unauthorized access.');
    }

     private function hasAccess($admin_data, $routeName)
    {
        echo "<pre>";
        print_r($admin_data);
        // print_r($routeName);
        die;
        // Define your permission logic based on route names
        $permissions = [
            'admin-dashboard' => 1, // Example permission key
            'change-password' => 1,
            'admin.add-contact' => $admin_data->user_registration_permission,
            'admin.addContact' => $admin_data->user_registration_permission,
            'admin.updateContact' => $admin_data->user_registration_permission,
            'admin.deleteContact' => $admin_data->user_registration_permission,
            'admin.customer' => $admin_data->customer_permission,
            'admin.assign' => $admin_data->lead_assign_permission,
            'admin.noneassign' => $admin_data->lead_assign_permission,
            'admin.email' => $admin_data->email_sms_permission,
            'admin.emailshow' => $admin_data->email_sms_permission,
            'admin.export' => $admin_data->report_permission,
            'admin.import' => $admin_data->report_permission,
            'admin.sms' => $admin_data->email_sms_permission,
            'admin.smsShow' => $admin_data->email_sms_permission,
            'admin.add-service' => $admin_data->service_permission,
            'admin.all-service' => $admin_data->service_permission,
            'admin.edit-service' => $admin_data->service_permission,
            'admin.invoice_list' => $admin_data->invoice_permission,
            'admin.view_invoice_per_customer' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,

            
            'admin.view_team_member' => $admin_data->invoice_permission,

            
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            'admin.view_invoice' => $admin_data->invoice_permission,
            // Add more routes and their corresponding permission keys here
        ];

        // Check if the route name exists in the permissions array

         if (array_key_exists($routeName, $permissions)) {
            if($permissions[$routeName]==1){
                echo "its accessable";
            }else{
                echo "its not accessable";
            }
      die;
        }
        // Default to denying access if no specific permissions are found
        return false;
    }



    }