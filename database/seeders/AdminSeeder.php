<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MainUserModel;
use App\Models\Role;
use App\Models\PermissionModel; 
use App\Models\Service; 



class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new MainUserModel();
        $admin->account_name = "admin";
        $admin->password = "1234";
        $admin->first_name = "Oradah";
        $admin->last_name = "";
        $admin->phone_number = "0000000000";
        $admin->email_address ="admin@gmail.com";
        $admin->user_type ="admin";
        $admin->save();

$permissions = new PermissionModel();
$permissions->user_id = $admin->id ;
$permissions->user_type = "admin" ;
$permissions->service_add = 1;
$permissions->service_view = 1;
$permissions->service_edit = 1;
$permissions->service_details_view = 1;
$permissions->role_edit = 1;
$permissions->staff_registration = 1;
$permissions->staff_view = 1;
$permissions->staff_edit = 1;
$permissions->staff_details_view = 1;
$permissions->package_add = 1;
$permissions->package_view = 1;
$permissions->package_edit = 1;
$permissions->report_count = 1;
$permissions->report_staff = 1;
$permissions->report_individual = 1;
$permissions->report_business = 1;
$permissions->leads_add = 1;
$permissions->leads_view = 1;
$permissions->leads_import_individual = 1;
$permissions->leads_import_business = 1;
$permissions->clients_view = 1;
$permissions->assign_manage = 1;
$permissions->invoice_view = 1;
$permissions->email_view = 1;
$permissions->sms_view = 1;
$permissions->payments_successful = 1;
$permissions->payments_failed = 1;
$permissions->login_history_view = 1;
$permissions->save();

$roles = [
    ['role_name'=>'admin','modern_name'=>'Admin'],
    ['role_name'=>'operation_manager','modern_name'=>'Operation Manager'],
    ['role_name'=>'team_manager','modern_name'=>'Team Manager'],
    ['role_name'=>'customer_success_manager','modern_name'=>'Team Member'],
    ['role_name'=>'book_keeper','modern_name'=>'Book Keeper'],
];

foreach ($roles as $key => $value) {
    $role = new Role();
    $role->role_name = $value['role_name'];
    $role->modern_name = $value['modern_name'];
    $role->save();
   
}

$category =  new Service();
$category->service_id =14;
$category->name = "uncategorized";
$category->save();


       
    }
}