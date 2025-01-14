<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use App\Models\UserModel; 
use App\Models\CustomerModel;
use App\Models\EmailModel;
use App\Exports\CustomerExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CustomerImport;
use App\Imports\IndividualImport;
use App\Models\TeamMember; 
use App\Models\Service; 
use App\Models\Invoice;
use App\Models\PaidCustomer;
use App\Models\MainUserModel;
use App\Models\PermissionModel;
use App\Models\RemarkModel;
use App\Models\MemberServiceModel;
use App\Models\EmailTemplate;
use App\Models\TeamManagersServicesModel;
use App\Models\Package;
use App\Models\LoginHistoryModel;
use App\Models\RoleService;
use App\Models\CustomerServiceModel;
use App\Models\CustomerPackageModel;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use DB;
use Twilio\Rest\Client;
use Crypt;
// use Mail;
use PDF;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class ContactController extends Controller
{

    //   THIS IS A  SWAL FUNCTION 
   public function swal($status , $title ,$icon){
        return response()->json([
             'status'=>$status,
             'title'=>$title,
             'icon'=>$icon 
        ]);
    }
//   THIS IS A  SWAL FUNCTION 

//   THIS IS A  SWAL FUNCTION 
   public function toastr($status , $title ,$icon,$msg){
        return response()->json([
             'status'=>$status,
             'title'=>$title,
             'icon'=>$icon, 
             'msg'=>$msg
        ]);
    }
//   THIS IS A  SWAL FUNCTION 
   public function userDetails($id){
        $user_details = MainUserModel::where('id',$id)->first();
        if($user_details->user_type=="admin"){
              $user_details = DB::table('main_user')
            ->join('permission','permission.user_id','main_user.id')
            ->join('roles','roles.role_name','=','main_user.user_type')
            ->where('main_user.id',$id)
            ->first();
            }else{
            $user_details = DB::table('main_user')
            ->join('permission', 'permission.user_id', '=', 'main_user.id')
            ->join('roles', 'roles.id', '=', 'main_user.user_type')
            ->where('main_user.id', $id)
            ->select(
            'main_user.id',
            'main_user.account_name',
            'main_user.password',
            'main_user.password_hint',
            'main_user.first_name',
            'main_user.last_name',
            'main_user.phone_number',
            'main_user.email_address',
            'main_user.change_password_upon_login',
            'main_user.disable_account',
            'main_user.created_at',
            'main_user.updated_at',
            'permission.*', // Include all columns from the permission table
            'roles.role_name as user_type' // Replace main_user.user_type with roles.role_name
            )
            ->first();
            }
         return $user_details;
      }
    public function userType($type){
      switch ($type) {
                  case 'customer_success_manager':
               return $user_type = "Customer Manager";
                    break;
                    case "team_manager":   
               return $user_type = "Team Manager";

                      break;
                      case "operation_manager":
               return $user_type = "Operation Manager";

                        break;
                        case "admin":
               return $user_type = "Admin";
                          break;
                          case "bookkeeper":
               return $user_type = "Bookkeeper";
                            break;
                  default:
                    break;
                }
              }
   
    // THIS IS contactAdd FUNCTION 
    public function contactAdd(Request $request){

     $phone = $request->phone;
      // $country_code = $request->country_code;
      $first_name = $request->first_name;
      $last_name = $request->last_name;
      $email = $request->email;
      // $manage = $request->manage;
      $user_type = $request->user_type;

      $services_status = 0;
       $services = $request->services;
      /*if($user_type=="team_manager" || $user_type=="operation_manager"){
        $services_status = 1;
      }
      if($user_type=="customer_success_manager"){
        $services_status = 2;
      }*/
      
      // NEW 
      $service_add = $request->service_add;
      $service_view = $request->service_view;
      $service_edit = $request->service_edit;
      $service_details_view = $request->service_details_view;
      $role_edit = $request->role_edit;
      $staff_registration = $request->staff_registration;
      $staff_view = $request->staff_view;
      $staff_edit = $request->staff_edit;
      $staff_details_view = $request->staff_details_view;
      $package_add = $request->package_add;
      $package_view = $request->package_view;
      $package_edit = $request->package_edit;
      $report_count = $request->report_count;
      $report_staff = $request->report_staff;
      $report_individual = $request->report_individual;
      $report_business = $request->report_business;
      $leads_add = $request->leads_add;
      $leads_view = $request->leads_view;
      $leads_import_individual = $request->leads_import_individual;
      $leads_import_business = $request->leads_import_business;
      $clients_view = $request->clients_view;
      $assign_manage = $request->assign_manage;
      $invoice_view = $request->invoice_view;
      $email_view = $request->email_view;
      $sms_view = $request->sms_view;
      $payments_successful = $request->payments_successful;
      $payments_failed = $request->payments_failed;
      $login_history_view = $request->login_history_view;

      // NEW 

      // OLD 
      
      // $service_manage = $request->service_manage;
      // $package = $request->package;
      // $leads_manage = $request->leads_manage;
      // $invoice_manage = $request->invoice_manage;
      // $payment_manage = $request->payment_manage;
      // $customer_manage = $request->customer_manage;
      // $email_sms_manage = $request->email_sms_manage;
      // $communication = $request->communication;
      // $report = $request->report;
      // $document_view = $request->document_view;
      // $document_download = $request->document_download;
      // $lead_assign = $request->lead_assign;
      // $history_manage = $request->history_manage;
      $account_name = $request->username;
      $password = $request->password;
      // $password_hint = $request->password_hint;
      // $after_login_setting_change = $request->after_login_setting_change;
      $disable_account = $request->disable_account;
      // $user_registration_permission = $request->user_registration;
      
      // OLD 

      

     if(MainUserModel::where('phone_number',$phone)->first()){
         return self::toastr(false,"Number Already Registered","warning","Warning");
     }
     if(MainUserModel::where('email_address',$email)->first()){
         return self::toastr(false,"Email Already Registered","warning","Warning");
     }
     if(MainUserModel::where('account_name',$account_name)->first()){
         return self::toastr(false,"Username Already Registered","warning","Warning");
     }


      $contact_details = new MainUserModel;
      $contact_details->account_name = $account_name;
      $contact_details->password=$password;
      // $contact_details->password_hint = $password_hint;
      $contact_details->first_name = $first_name;
      $contact_details->last_name	 = $last_name ;
      $contact_details->phone_number = $phone ;
      $contact_details->email_address = $email ;
      $contact_details->user_type = $user_type ;
      // $contact_details->change_password_upon_login = $after_login_setting_change ;
      $contact_details->disable_account = $disable_account ;
      $contact_details->save();
      
      $user_id = $contact_details->id;

$permissions = new PermissionModel;
  $permissions->user_id = $user_id ;
 $permissions->user_type = $user_type ;
$permissions->service_add = $request->service_add;
$permissions->service_view = $request->service_view;
$permissions->service_edit = $request->service_edit;
$permissions->service_details_view = $request->service_details_view;
$permissions->role_edit = $request->role_edit;
$permissions->staff_registration = $request->staff_registration;
$permissions->staff_view = $request->staff_view;
$permissions->staff_edit = $request->staff_edit;
$permissions->staff_details_view = $request->staff_details_view;
$permissions->package_add = $request->package_add;
$permissions->package_view = $request->package_view;
$permissions->package_edit = $request->package_edit;
$permissions->report_count = $request->report_count;
$permissions->report_staff = $request->report_staff;
$permissions->report_individual = $request->report_individual;
$permissions->report_business = $request->report_business;
$permissions->leads_add = $request->leads_add;
$permissions->leads_view = $request->leads_view;
$permissions->leads_import_individual = $request->leads_import_individual;
$permissions->leads_import_business = $request->leads_import_business;
$permissions->clients_view = $request->clients_view;
$permissions->assign_manage = $request->assign_manage;
$permissions->invoice_view = $request->invoice_view;
$permissions->email_view = $request->email_view;
$permissions->sms_view = $request->sms_view;
$permissions->payments_successful = $request->payments_successful;
$permissions->payments_failed = $request->payments_failed;
$permissions->login_history_view = $request->login_history_view;
 $permissions->save();


// OLD 

      // $permissions->user_id = $user_id ;
      // $permissions->user_type = $user_type ;
      // $permissions->service_permission = $service_manage ;
      // $permissions->leads_permission = $leads_manage ;
      // $permissions->invoice_permission = $invoice_manage ;
      // $permissions->payment_permission = $payment_manage ;
      // $permissions->customer_permission = $customer_manage ;
      // $permissions->email_sms_permission = $email_sms_manage ;
      // $permissions->communication_permission = $communication ;
      // $permissions->report_permission = $report ;
      // $permissions->document_view_permission = $document_view ;
      // $permissions->document_download_permission = $document_download ;
      // $permissions->lead_assign_permission = $lead_assign ;
      // $permissions->login_history_permission = $history_manage ;
      // $permissions->package_permission = $package;
      // $permissions->user_registration_permission = $user_registration_permission ;

      // OLD 
      
   /* if($services_status==1){
     foreach ($services as $key => $value) {
      $data = new TeamManagersServicesModel;
      $data->team_manager_id = $user_id;
      $data->managers_services_id = $value;
      $data->save();
     }
     
    }
    if($services_status==2){
      foreach ($services as $key => $value) {
        $data = new MemberServiceModel;
        $data->member_id = $user_id;
        $data->member_service_id = $value;
        $data->save();
      }
    }*/
    if(!empty($services)){
     foreach ($services as $key => $value) {
        $data = new RoleService;
        $data->member_id = $user_id;
        $data->service_id = $value;
        $data->user_type=$user_type;
        $data->save();
      } 
    }

      return self::toastr(true,"Registration Successfully","success","Success");
      
    }
    // THIS IS contactAdd FUNCTION 



// THIS IS editUserPage FUNCTION   

  public function editUserPage($contact_id){
     $id = session('admin');
     $admin_data = self::userDetails($id);
     $user_type = self::userType($admin_data->user_type);
     $data = MainUserModel::find($contact_id);
     $roles = Role::where('role_name','!=','admin')->orderBy('id','DESC')->get();

     $services = Service::orderBy('service_id','DESC')->where('name','!=','Uncategorized')->get();     
     $permissions_data = PermissionModel::where('user_id',$contact_id)->first();
     $user_details =  DB::table("main_user")
      ->join("permission",'permission.user_id','=','main_user.id')
       ->where('main_user.id',$contact_id)
      ->first();
     $services_he_manage = DB::table('role_services')->where('member_id',$user_details->user_id)
      ->join('services','services.service_id','=','role_services.service_id')->get();
    
    //  $team_services_id=''; $s_data='';$customer_service='';
     
    /* if($data['user_type'] == 'team_manager'){

      $user_details =  DB::table("main_user")
      ->join("permission",'permission.user_id','=','main_user.id')
       ->where('main_user.id',$contact_id)
      ->first();

      $services_he_manage = DB::table('team_manager_services')->where('team_manager_id',$user_details->user_id)
      ->join('services','services.service_id','=','team_manager_services.managers_services_id')->get();
     }else if($data['user_type'] == 'customer_success_manager'){

       $user_details =  DB::table("main_user")
      ->join("permission",'permission.user_id','=','main_user.id')
       ->where('main_user.id',$contact_id)
      ->first();

      $services_he_manage = DB::table('member_service')->where('member_id',$user_details->user_id)
      ->join('services','services.service_id','=','member_service.member_service_id')
      ->get();

      // echo "<pre>";
      // print_r($user_details); die;
     }
     else if($data['user_type'] == 'operation_manager'){

      $user_details =  DB::table("main_user")
     ->join("permission",'permission.user_id','=','main_user.id')
      ->where('main_user.id',$contact_id)
     ->first();
    //  $services_he_manage = Service::orderBy("service_id","DESC")->get();
       $services_he_manage = DB::table('team_manager_services')->where('team_manager_id',$user_details->user_id)
      ->join('services','services.service_id','=','team_manager_services.managers_services_id')->get();
     // echo "<pre>";
     // print_r($services_he_manage); die;
    }*/
return view('admin.dashboard.edit_contact',['admin_data'=>$admin_data,'data'=>$data,'services'=>$services,'user_details'=>$user_details,'services_he_manage'=>$services_he_manage,'user_type'=>$user_type,'roles'=>$roles]);
   
  }
 
// THIS IS editUserPage FUNCTION   

// THIS IS updateContact FUNCTION 

public function updateContact(Request $request){
      $phone = $request->phone;
      $first_name = $request->first_name;
      $last_name = $request->last_name;
      $email = $request->email;
      $user_type = $request->user_type;
      $user_id = $request->main_user_id;
      $permissions_id = $request->permissions_id;
      $account_name = $request->username;
      $disable_account = $request->disable_account;
      $password = $request->password;
      $password_hint = $request->password_hint;
     
      $service_add = $request->service_add;
      $service_view = $request->service_view;
      $service_edit = $request->service_edit;
      $service_details_view = $request->service_details_view;
      $role_edit = $request->role_edit;
      $staff_registration = $request->staff_registration;
      $staff_view = $request->staff_view;
      $staff_edit = $request->staff_edit;
      $staff_details_view = $request->staff_details_view;
      $package_add = $request->package_add;
      $package_view = $request->package_view;
      $package_edit = $request->package_edit;
      $report_count = $request->report_count;
      $report_staff = $request->report_staff;
      $report_individual = $request->report_individual;
      $report_business = $request->report_business;
      $leads_add = $request->leads_add;
      $leads_view = $request->leads_view;
      $leads_import_individual = $request->leads_import_individual;
      $leads_import_business = $request->leads_import_business;
      $clients_view = $request->clients_view;
      $assign_manage = $request->assign_manage;
      $invoice_view = $request->invoice_view;
      $email_view = $request->email_view;
      $sms_view = $request->sms_view;
      $payments_successful = $request->payments_successful;
      $payments_failed = $request->payments_failed;
      $login_history_view = $request->login_history_view;


     /* $service_manage = $request->service_manage;
      $leads_manage = $request->leads_manage;
      $invoice_manage = $request->invoice_manage;
      $payment_manage = $request->payment_manage;
      $customer_manage = $request->customer_manage;
      $email_sms_manage = $request->email_sms_manage;
      

      $communication = $request->communication;
      $report = $request->report;
      $document_view = $request->document_view;
      // $client_financial = $request->client_financial;

      // $client_contact_info = $request->client_contact_info;
      // $delete_client = $request->delete_client;
      // $delete_all_record = $request->delete_all_record;

      $document_download = $request->document_download;
      $lead_assign = $request->lead_assign;
      // $email_template = $request->email_template;
      
      $history_manage = $request->history_manage;
      // $change_password_upon_login = $request->after_login_setting_change;
      $disable_account = $request->disable_account;
      // $team_manager_permission = $request->manager_manage;
      // $customer_success_manager_permission = $request->member_manage;
      $user_registration_permission = $request->user_registration;
      $package = $request->package;*/
      
      $contact_details = MainUserModel::find($user_id);
      $contact_details->account_name = $account_name;
      $contact_details->password=$password;
      $contact_details->user_type=$user_type;
      $contact_details->password_hint = $password_hint;
      $contact_details->first_name = $first_name;
      $contact_details->last_name  = $last_name ;
      $contact_details->phone_number = $phone ;
      $contact_details->email_address = $email ;
      //$contact_details->change_password_upon_login = $change_password_upon_login ;
      $contact_details->disable_account = $disable_account ;
      $contact_details->save();
      
      $permissions = PermissionModel::find($permissions_id);
     /* $permissions->service_permission = $service_manage ;
      // $permissions->team_manager_permission = $team_manager_permission ;
      // $permissions->customer_success_manager_permission = $customer_success_manager_permission ;
      $permissions->leads_permission = $leads_manage ;
      $permissions->invoice_permission = $invoice_manage ;
      $permissions->payment_permission = $payment_manage ;
      $permissions->customer_permission = $customer_manage ;
      $permissions->email_sms_permission = $email_sms_manage ;
      $permissions->communication_permission = $communication ;
      $permissions->report_permission = $report ;
      $permissions->document_view_permission = $document_view ;
      // $permissions->client_financial_data_permission = $client_financial ;
      // $permissions->client_contact_permission = $client_contact_info ;
      // $permissions->customer_success_manager_permission = $customer_success_manager_permission;
      // $permissions->delete_client_record_permission =$delete_client;
      // $permissions->delete_all_record_permission = $delete_all_record ;
      $permissions->document_download_permission = $document_download ;
      $permissions->lead_assign_permission = $lead_assign;
      // $permissions->email_template_permission = $email_template ;
      $permissions->login_history_permission = $history_manage ;
      $permissions->user_registration_permission = $user_registration_permission ;
      $permissions->package_permission = $package;*/
      $permissions->service_add = $request->service_add;
      $permissions->service_view = $request->service_view;
      $permissions->service_edit = $request->service_edit;
      $permissions->service_details_view = $request->service_details_view;
      $permissions->role_edit = $request->role_edit;
      $permissions->staff_registration = $request->staff_registration;
      $permissions->staff_view = $request->staff_view;
      $permissions->staff_edit = $request->staff_edit;
      $permissions->staff_details_view = $request->staff_details_view;
      $permissions->package_add = $request->package_add;
      $permissions->package_view = $request->package_view;
      $permissions->package_edit = $request->package_edit;
      $permissions->report_count = $request->report_count;
      $permissions->report_staff = $request->report_staff;
      $permissions->report_individual = $request->report_individual;
      $permissions->report_business = $request->report_business;
      $permissions->leads_add = $request->leads_add;
      $permissions->leads_view = $request->leads_view;
      $permissions->leads_import_individual = $request->leads_import_individual;
      $permissions->leads_import_business = $request->leads_import_business;
      $permissions->clients_view = $request->clients_view;
      $permissions->assign_manage = $request->assign_manage;
      $permissions->invoice_view = $request->invoice_view;
      $permissions->email_view = $request->email_view;
      $permissions->sms_view = $request->sms_view;
      $permissions->payments_successful = $request->payments_successful;
      $permissions->payments_failed = $request->payments_failed;
      $permissions->login_history_view = $request->login_history_view;

      $permissions->user_type = $user_type;
      $permissions->save();
      
      $services = $request->services;
      $services_status = 0;
      
      /*if($user_type=="team_manager" || $user_type=="operation_manager"){
        
        $manager_services = TeamManagersServicesModel::where('team_manager_id',$user_id)->get();
        foreach($manager_services as $service){
            $delete = TeamManagersServicesModel::find($service->id)->delete();
        }
           foreach($services as $service){
            $add = new TeamManagersServicesModel();
            $add->team_manager_id = $user_id ;
            $add->managers_services_id = $service;
            $add->save();
        }
      }else if($user_type=="customer_success_manager"){

        $user_id =$request->main_user_id;
        $member_services = MemberServiceModel::where('member_id',$user_id)->get();
        foreach($member_services as $service){
          $delete = MemberServiceModel::find($service->id)->delete();
      }
        if(!empty($services)){
        foreach ($services as $key => $value) {
         $services_data=new MemberServiceModel();
         $services_data->member_id = $user_id ;
        $services_data->member_service_id =$value;  
        $services_data->save();
        }
      }
      }*/
       $role_services = RoleService::where('member_id',$user_id)->get();
        foreach($role_services as $service){
            $delete = RoleService::find($service->role_services_id)->delete();
        }
           foreach($services as $service){
            $add = new RoleService();
            $add->member_id = $user_id ;
            $add->service_id = $service;
            $add->user_type = $user_type;
            $add->save();
        }
    return self::toastr(true,"Updated Successfully","success","Success");
     
}

// THIS IS updateContact FUNCTION 

// THIS IS A deleteTeam FUNCTION 
public function deleteTeam(Request $request){
    $id = $request->id;
   
    $delete = MainUserModel::find($id)->delete();
    if($delete){
  return self::swal(true,'Deleted','success');
    }else{
  return self::swal(false,'Technical Issue','error');
        
    }
}

// THIS IS A deleteTeam FUNCTION 

//  THIS IS Clientspage FUNCTION 
public function Clientspage(){
  $id = session('admin');
   $admin_data = AdminModel::find($id);
   $customers = CustomerModel::orderBy('customer_id','DESC')->get();
  return view('admin.dashboard.customers',['admin_data'=>$admin_data,'data'=>$customers]);
}
//  THIS IS Clientspage FUNCTION 


//  THIS IS assginClientspage FUNCTION 
public function assginClientspage(Request $request){

  $service_filter = $request->service;
  $id = session('admin');
   $admin_data = self::userDetails($id);
   $user_type = self::userType($admin_data->user_type);

  if($admin_data->user_type=="admin"){
   $services = Service::orderBy('service_id','DESC')->get();
    if($service_filter !=""){
      /*$customers =DB::table('customer')->join('services','services.service_id','=','customer.customer_service_id')->where('customer.team_member','!=',null)
      ->where('customer.customer_service_id',$service_filter)->orderBy('customer_id','DESC')->paginate(10);*/
      $customers = DB::table('customer')
        ->select(
            'customer.customer_email',
            DB::raw('MAX(customer.customer_id) as customer_id'),
            DB::raw('MAX(customer.customer_number) as customer_number'),
            DB::raw('MAX(customer.customer_name) as customer_name'),
            DB::raw('MAX(customer.status) as status'),
            DB::raw('MAX(customer.type) as type'),
            DB::raw('MAX(customer.city) as city'),
            DB::raw('MAX(customer.state) as state'),
            DB::raw('MAX(services.service_id) as service_id'),
            DB::raw('MAX(customer.msg) as msg'),
            DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
        )
        ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
        ->groupBy('customer.customer_email') 
        ->where('customer.team_member','!=',null)    
        ->where('customer.customer_service_id',$service_filter) 
        ->orderBy('customer_id','DESC')
        ->paginate(10);

    }else{
        /* $customers =DB::table('customer')->join('services','services.service_id','=','customer.customer_service_id')->where('customer.team_member','!=',null)->orderBy('customer_id','DESC')->paginate(10);*/
        $customers = DB::table('customer')
        ->select(
            'customer.customer_email',
            DB::raw('MAX(customer.customer_id) as customer_id'),
            DB::raw('MAX(customer.customer_number) as customer_number'),
            DB::raw('MAX(customer.customer_name) as customer_name'),
            DB::raw('MAX(customer.status) as status'),
            DB::raw('MAX(customer.type) as type'),
            DB::raw('MAX(services.service_id) as service_id'),
            DB::raw('MAX(customer.msg) as msg'),
            DB::raw('MAX(customer.city) as city'),
            DB::raw('MAX(customer.state) as state'),
            DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
        )
        ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
        ->groupBy('customer.customer_email') 
        ->where('customer.team_member','!=',null)     
        ->orderBy('customer_id','DESC')
        ->paginate(10);

    }
  }else if($admin_data->user_type=="team_manager" || $admin_data->user_type=="operation_manager"){
    $team_manager_services=TeamManagersServicesModel::where('team_manager_id',$admin_data->id)->get();
        if(!empty($team_manager_services)){
           $service_id = [];
            foreach($team_manager_services as $service){
              $service_id[] = $service->managers_services_id;
            }
            $services = Service::whereIn('service_id',$service_id)->get();

     if($service_filter!=""){
               $customers = DB::table('customer')
              ->select(
                  'customer.customer_email',
                  DB::raw('MAX(customer.customer_id) as customer_id'),
                  DB::raw('MAX(customer.customer_number) as customer_number'),
                  DB::raw('MAX(customer.customer_name) as customer_name'),
                  DB::raw('MAX(customer.status) as status'),
                  DB::raw('MAX(customer.type) as type'),
                  DB::raw('MAX(services.service_id) as service_id'),
                  DB::raw('MAX(customer.city) as city'),
                  DB::raw('MAX(customer.state) as state'),           
                  DB::raw('MAX(customer.msg) as msg'),
                  DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
              )
              ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
              ->groupBy('customer.customer_email') 
              ->where('customer.team_member','!=',null)     
              ->where('customer.customer_service_id',$service_filter)
              ->whereIn('customer.customer_service_id',$service_id)
              ->paginate(10);

          }else{
             $customers = DB::table('customer')
              ->select(
                  'customer.customer_email',
                  DB::raw('MAX(customer.customer_id) as customer_id'),
                  DB::raw('MAX(customer.customer_number) as customer_number'),
                  DB::raw('MAX(customer.customer_name) as customer_name'),
                  DB::raw('MAX(customer.status) as status'),
                  DB::raw('MAX(customer.type) as type'),
                  DB::raw('MAX(services.service_id) as service_id'),
                  DB::raw('MAX(customer.msg) as msg'),
                  DB::raw('MAX(customer.city) as city'),
                  DB::raw('MAX(customer.state) as state'),
                  DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
              )
              ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
              ->groupBy('customer.customer_email') 
              ->where('customer.team_member','!=',null)     
              ->whereIn('customer.customer_service_id',$service_id)
              ->paginate(10);

          }
          
        }
       
  }

  //  $team = MainUserModel::where('user_type','customer_success_manager')->get();

  return view('admin.dashboard.assign_client',['user_type'=>$user_type,'admin_data'=>$admin_data,'data'=>$customers,'services'=>$services]);



  //  $id = session('admin');
  //  $admin_data = self::userDetails($id);
  //  $user_type = self::userType($admin_data->user_type);
  //  $team = MainUserModel::where('user_type','customer_success_manager')->get();

  // $service = $request->service;
  // $teamMembersId = MainUserModel::all()->pluck('id')->toArray(); // Directly get IDs as an array
  // $customer_id = CustomerModel::all()->pluck('team_member')->toArray(); // Directly get IDs as an array
  //   if($service !=""){
  //     $customers =DB::table('customer')->join('services','services.service_id','=','customer.customer_service_id')->join('main_user','main_user.id','=','customer.team_member')->where('customer.customer_service_id',$service)->orderBy('customer_id','DESC')->get();
  //   }else{
  //         $customers = DB::table('customer')
  //       ->select('customer.*', 'services.name') // Adjust fields as needed
  //       ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
  //       ->whereIn('customer.team_member',$customer_id)
  //       ->orderBy('customer.customer_id', 'DESC')
  //       ->get();
  //   }
   
  // return view('admin.dashboard.assign_client',['admin_data'=>$admin_data,'data'=>$customers,'team'=>$team,'user_type'=>$user_type]);


}

//  THIS IS assginClientspage FUNCTION 

public function getServiceBasedMembers(Request $request)
{
    $id = $request->id;
    if (!empty($id)) {
        // Remove duplicate service IDs by using array_unique
        $uniqueIds = array_unique($id);
        
        $members = DB::table('main_user')
            ->join('member_service', 'member_service.member_id', '=', 'main_user.id')
            ->whereIn('member_service.member_service_id', $uniqueIds) // Use whereIn to filter
            ->groupBy('main_user.id', 'main_user.first_name', 'main_user.last_name')
            ->havingRaw('COUNT(DISTINCT member_service.member_service_id) = ?', [count($uniqueIds)]) // Check that the count matches
            ->select('main_user.id', 'main_user.first_name', 'main_user.last_name')
            ->get();
    } else {
        // Handle the case where $id is empty
        $members = collect(); // Return an empty collection
    }
    return response()->json($members);
}



//  THIS IS noneAssginClientspage FUNCTION 
public function noneAssginClientspage(Request $request){
    $service_filter = $request->service;
    $id = session('admin');
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);

    if($admin_data->user_type=="admin"){
   $services = Service::orderBy('service_id','DESC')->get();
    if($service_filter !=""){
     /* $customers =DB::table('customer')->join('services','services.service_id','=','customer.customer_service_id')->where('customer.team_member',null)
      ->where('customer.customer_service_id',$service_filter)->orderBy('customer_id','DESC')->paginate(10);*/
      $customers = DB::table('customer')
        ->select(
            'customer.customer_email',
            DB::raw('MAX(customer.customer_id) as customer_id'),
            DB::raw('MAX(customer.customer_number) as customer_number'),
            DB::raw('MAX(customer.customer_name) as customer_name'),
            DB::raw('MAX(customer.status) as status'),
            DB::raw('MAX(customer.city) as city'),
            DB::raw('MAX(customer.state) as state'),
            DB::raw('MAX(customer.type) as type'),
            DB::raw('MAX(services.service_id) as service_id'),
            DB::raw('MAX(customer.msg) as msg'),
            DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
        )
        ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
        ->groupBy('customer.customer_email') 
        ->where('customer.team_member',null)
        ->where('customer.customer_service_id',$service_filter)
        ->orderBy('customer_id','DESC')
        ->paginate(10);

    }else{
        /* $customers =DB::table('customer')->join('services','services.service_id','=','customer.customer_service_id')->where('customer.team_member',null)->orderBy('customer_id','DESC')->paginate(10);*/
        $customers = DB::table('customer')
        ->select(
            'customer.customer_email',
            DB::raw('MAX(customer.customer_id) as customer_id'),
            DB::raw('MAX(customer.customer_number) as customer_number'),
            DB::raw('MAX(customer.customer_name) as customer_name'),
            DB::raw('MAX(customer.status) as status'),
            DB::raw('MAX(customer.type) as type'),
             DB::raw('MAX(customer.city) as city'),
            DB::raw('MAX(customer.state) as state'),
            DB::raw('MAX(services.service_id) as service_id'),
            DB::raw('MAX(customer.msg) as msg'),
            DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
        )
        ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
        ->groupBy('customer.customer_email') 
        ->where('customer.team_member',null)
        ->orderBy('customer_id','DESC')
        ->paginate(10);

    }
  }else if($admin_data->user_type=="team_manager" || $admin_data->user_type=="operation_manager"){
    
  $team_manager_services=TeamManagersServicesModel::where('team_manager_id',$admin_data->id)->get();
  if(!empty($team_manager_services)){
     $service_id = [];
      foreach($team_manager_services as $service){
        $service_id[] = $service->managers_services_id;
      }
      $services = Service::whereIn('service_id',$service_id)->get();
      if($service_filter!=""){
        $customers = DB::table('customer')
        ->select(
            'customer.customer_email',
            DB::raw('MAX(customer.customer_id) as customer_id'),
            DB::raw('MAX(customer.customer_number) as customer_number'),
            DB::raw('MAX(customer.customer_name) as customer_name'),
            DB::raw('MAX(customer.status) as status'),
            DB::raw('MAX(customer.city) as city'),
            DB::raw('MAX(customer.state) as state'),
            DB::raw('MAX(services.service_id) as service_id'),
            DB::raw('MAX(customer.msg) as msg'),
            DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
        )
        ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
        ->groupBy('customer.customer_email') 
        ->where('customer.team_member',null)
        ->whereIn('customer.customer_service_id',$service_id)
        ->where('customer.customer_service_id',$service_filter)
        ->paginate(10);


       }else{
        $customers = DB::table('customer')
        ->select(
            'customer.customer_email',
            DB::raw('MAX(customer.customer_id) as customer_id'),
            DB::raw('MAX(customer.customer_number) as customer_number'),
            DB::raw('MAX(customer.customer_name) as customer_name'),
            DB::raw('MAX(customer.city) as city'),
            DB::raw('MAX(customer.state) as state'),
            DB::raw('MAX(customer.status) as status'),
            DB::raw('MAX(services.service_id) as service_id'),
            DB::raw('MAX(customer.msg) as msg'),
            DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
        )
        ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
        ->groupBy('customer.customer_email') 
        ->where('customer.team_member',null)
        ->whereIn('customer.customer_service_id',$service_id)
        ->paginate(10);

       }
      }

    }


   
  //  $team = MainUserModel::where('user_type','customer_success_manager')->get();




  return view('admin.dashboard.none_assign_client',['user_type'=>$user_type,'admin_data'=>$admin_data,'data'=>$customers,'services'=>$services]);

}
//  THIS IS noneAssginClientspage FUNCTION 

// THIS IS  assign FUNCTION 
public function assign(Request $request){
  $customers[] = $request->customer;
  $team_member = $request->team_member;
  
  foreach ($customers[0] as $key => $value) {
  $update = CustomerModel::find($value);
  $update->team_member=$team_member;
  $update->save();
  }
  return self::swal(true,'Assign Successfull','success');
}

public function updateAssign(Request $request){
  $customers[] = $request->customer;
  $team_member = $request->team_member;
  
  foreach ($customers[0] as $key => $value) {
  $update = CustomerModel::find($value);
  $update->team_member=$team_member;
  $update->save();
  }
  return self::swal(true,'Update Successfull','success');
}
// THIS IS  assign FUNCTION 
// THIS IS emailPage FUNCTION 
public function emailPage(){
   $id = session('admin');
   $admin_data = self::userDetails($id);
   $user_type = self::userType($admin_data->user_type);

   if($admin_data->user_type == 'admin'){
      $emails = DB::table('main_user')
     ->join('email_send','email_send.email_admin','=','main_user.id')
     ->join('customer','customer.customer_id','=','email_send.email_customer')
     ->orderBy('email_send.email_id','DESC')
     ->select('email_send.*','customer.customer_name')
     ->paginate(10);
   }
   else{
     $emails = DB::table('main_user')
     ->join('email_send','email_send.email_admin','=','main_user.id')
     ->join('customer','customer.customer_id','=','email_send.email_customer')
     ->where('email_send.email_admin',$admin_data->user_id)
     ->orderBy('email_send.email_id','DESC')
     ->select('email_send.*','customer.customer_name')
     ->paginate(10);  
   }

   
  //  echo "<pre>";
  //  print_r($emails);
  //  die;
   
  return view('admin.dashboard.all_email',['admin_data'=>$admin_data,'data'=>$emails,'user_type'=>$user_type]);
}
// THIS IS emailPage FUNCTION 

// THIS IS emailShow FUNCTION 

public function emailShow($email_id){
     $id = session('admin');
    $admin_data = self::userDetails($id);
    $user_type = $admin_data->user_type;

  $email_id = decrypt($email_id);
   $email_details = DB::table('main_user')
   ->join('email_send','email_send.email_admin','=','main_user.id')
   ->join('customer','customer.customer_id','=','email_send.email_customer')
   ->where('email_send.email_id',$email_id)
   ->get(['email_send.*','main_user.first_name','main_user.last_name','main_user.user_type','customer.customer_name']);



  return view('admin.dashboard.email_show',['user_type'=>$user_type,'admin_data'=>$admin_data,'data'=>$email_details[0]]);
  
}

// THIS IS emailShow FUNCTION 


// THIS IS EXPORT FUNCTION 

public function export()
    {
        return Excel::download(new CustomerExport(), 'clients.xlsx');
    }
   public function filterUsers(Request $request){
      $filter = $request->filter;
      $roles = Role::where('role_name','!=','admin')->orderBy('id','DESC')->get();
        $id = session('admin');
          $admin_data = self::userDetails($id);
         
               $contact_data = DB::table('main_user')->join('permission','permission.user_id','=','main_user.id')->join('roles','roles.id','=','main_user.user_type')->orderBy('main_user.id','DESC')->where('main_user.user_type',"!=",'admin')->select('main_user.*','roles.modern_name')->paginate(10);
        
         return view('admin.dashboard.contacts',['admin_data'=>$admin_data,'data'=>$contact_data,'roles'=>$roles]);

    }


   

// THIS IS EXPORT FUNCTION 

// THIS IS IMPORT FUNCTION 
  public function import(Request $request){ 
       $file_ex = $request->csv->getClientOriginalExtension();
    if($file_ex=="csv"|| $file_ex=="xls"|| $file_ex=="xlsx"){
        Excel::import(new CustomerImport,
        request()->file('csv'));
        // if($file==true){
         return self::toastr(true,'All Leads Uploaded Successfull','success','Success');    
        // }else{
      // return self::toastr('error','Sorry Not Upload Clients','error','Error');    
        // }

    }else{
          return self::toastr(false,'Please Upload csv , xls or xlsx Files','error','Error');    
    } 
    
    }


     public function individualImport(Request $request) 
    {
       $file_ex = $request->csv->getClientOriginalExtension();
    if($file_ex=="csv"|| $file_ex=="xls"|| $file_ex=="xlsx"){
        Excel::import(new IndividualImport,
        request()->file('csv'));
        // if($file==true){
         return self::toastr(true,'All Leads Uploaded Successfull','success','Success');    
        // }else{
      // return self::toastr('error','Sorry Not Upload Clients','error','Error');    
        // }

    }else{
          return self::toastr(false,'Please Upload csv , xls or xlsx Files','error','Error');    
    } 
    
    }

    
// THIS IS IMPORT FUNCTION 

// THIS IS importPage FUNCTION  
public function importPage(){
 
       $id = session('admin');
      $admin_data = self::userDetails($id);
      $user_type = self::userType($admin_data->user_type);
    return view('admin.dashboard.import_customer',['admin_data'=>$admin_data,'user_type'=>$user_type]);
}

// THIS IS importPage FUNCTION  


// THIS IS smsPage FUNCTION 
public function smsPage(){
   $id = session('admin');
   //$admin_data = AdminModel::find($id);
   $admin_data = self::userDetails($id);
   $user_type = self::userType($admin_data->user_type);
   if($admin_data->user_type=="admin"){
          $sms = DB::table('main_user')
         ->join('messages','messages.team_member_id','=','main_user.id')
         ->join('customer','customer.customer_id','=','messages.customer_msg_id')
         ->orderBy('messages.messages_id','DESC')
         ->paginate(10);
   }else{
        $sms = DB::table('main_user')
         ->join('messages','messages.team_member_id','=','main_user.id')
         ->join('customer','customer.customer_id','=','messages.customer_msg_id')
         ->where('messages.team_member_id','=',$admin_data->user_id)
         ->orderBy('messages.messages_id','DESC')
         ->paginate(10);
   }
  return view('admin.dashboard.all_sms',['admin_data'=>$admin_data,'data'=>$sms,'user_type'=>$user_type]);
}


// THIS IS smsShow FUNCTION 

public function smsShow($id){
     $team_id = session('admin');
   $admin_data = AdminModel::find($team_id);

   
  $sms_id = decrypt($id);
   $sms_details = DB::table('user')
   ->join('messages','messages.team_member_id','=','user.user_id')
   ->join('customer','customer.customer_id','=','messages.customer_msg_id')
   ->where('messages.messages_id',$sms_id)
   ->get();
  //  echo "<pre>";
  // print_r($sms_details);
  // die();

  return view('admin.dashboard.sms_show',['admin_data'=>$admin_data,'data'=>$sms_details[0]]);
  
}
// THIS IS smsShow FUNCTION 

// THIS IS deleteClient FUNCTION 
  public function deleteClient(Request $request){
    $id = $request->id;
    $delete = CustomerModel::find($id)->delete();
    if($delete){
  return self::toastr(true,'Deleted Successfull','success','Success');
    }else{
  return self::toastr(false,'Technical Issue','error','Error');
        
    }
}
// THIS IS deleteClient FUNCTION 
// THIS IS create_team_members FUNCTION 
    public function create_team_members(Request $request){
     $phone= $request->phone;
      $country_code = $request->country_code;
      $name = $request->name;
      $email = $request->email;
      $password = $request->password;
      $service =$request->service_id;
     if(TeamMember::where('phone_number',$phone)->first()){
         return self::toastr(false,"Number Already Registered","error","Error");
     }
     if(TeamMember::where('email',$email)->first()){
         return self::toastr(false,"Email Already Registered","error","Error");
     }

      $team_members_details = new TeamMember;
      $team_members_details->name = $name;
      $team_members_details->team_service=$service;
      $team_members_details->country_code = $country_code;
      $team_members_details->phone_number = $phone;
      $team_members_details->email = $email ;
      $team_members_details->password = $password ;
      $save = $team_members_details->save();
      if($save){
         return self::toastr(true,"Team Member Add Successfull","success","Success");
      }else{
         return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      }
      
    }
    // TeamMembersLists FUNCTION Start
    public function teammembersLists(){
      $id = session('admin');
      $admin_data = MainUserModel::find($id);
      $members_data = DB::table('team_member')
      ->join('services', 'services.service_id', '=', 'team_member.team_service')
      ->select('team_member.*', 'services.name as service_name')
      ->orderBy('team_member.team_member_id', 'DESC')
      ->get();
      return view('admin.dashboard.team_member_lists',['admin_data'=>$admin_data,'data'=>$members_data]);
    }
    
    

    // public function operationManagerList($id){
          
    //   $id = session('admin');
    //   $admin_data = MainUserModel::find($id);
    //        $user_type = self::userType($admin_data->user_type);
      
    // $members_data = DB::table('team_manager_services')
    // ->join('services', 'services.service_id', '=', 'team_manager_services.managers_services_id')
    // ->where('services.serivce_id',$id)
    // ->get()
    // ->unique('managers_services_id'); 

    // echo "<pre>";
    // print_r($members_data);
    // die;

    // $op_id = [];
    // foreach ($members_data as $key => $value) {
    //   $op_id[] = $value->team_manager_id;
    // }
    //   $members_data = DB::table('main_user')
    // ->join('team_manager_services', 'team_manager_services.team_manager_id', '=', 'main_user.id')
    // ->orderBy('team_manager_services.team_manager_id', 'DESC')

    // ->paginate(10)
    // ->unique('main_user.email_address');
    
    //   echo "<pre>";
    //   print_r($members_data);
    //   die;
    // return view('admin.dashboard.service_team_managers',['admin_data'=>$admin_data,'team_manager'=>$members_data,'user_type'=>$user_type]);

    //   // return view('admin.dashboard.members_list',['admin_data'=>$admin_data,'team_member'=>$members_data]);
    // }


    
    // TeamMembersLists FUNCTION End
    //TeamMember Delete FUNCTION
    public function team_member_delete(Request $request){
      $id = $request->id;
      $delete = TeamMember::find($id)->delete();
      if($delete){
        return self::swal(true,'Deleted','success');
      }else{
        return self::swal(false,'Technical Issue','error');
        
      }
    }
    //TeamMember Delete FUNCTION
    // THIS IS editTeamMember FUNCTION   
    public function editTeamMember($team_member_id){
      $id = session('admin');
      $admin_data = AdminModel::find($id);

      $team_member_id =   Crypt::decrypt($team_member_id);
      $data = TeamMember::find($team_member_id);
      $services = Service::orderBy('service_id','DESC')->get();
      return view('admin.dashboard.edit_team_member',['admin_data'=>$admin_data,'data'=>$data,'services_data'=>$services]);
    }
   // THIS IS updateMembers FUNCTION   
   public function updateMembers(Request $request){
  
     $phone= $request->phone;
     $country_code=$request->country_code;

      $name = $request->name;
      $email = $request->email;
      $password = $request->password;
      $service =$request->team_service;
        $team_member_id = $request->team_member_id;
     $member_details = TeamMember::find($team_member_id);
      $member_details->name = $name;
      $member_details->team_service = $service;
      $member_details->phone_number = $phone ;
      $member_details->email = $email ;
      $member_details->country_code = $country_code ;
      $member_details->password = $password ;
      $save = $member_details->save();
      if($save){
         return self::toastr(true,"Team Member Details Updated Successfull","success","Success");
      }else{
         return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      }
  }
  //invoiceList FUNCTION START
  public function invoiceList($id){
    $user_id=session('admin');
    $admin_data = self::userDetails($user_id);
    $user_type = self::userType($admin_data->user_type);
    $main_user_data =MainUserModel::find($id);
    $role_services=RoleService::where('member_id',$id)->get();
       if(!empty($role_services)){
         $service_id=[];
         foreach($role_services as $services){
          $service_id[]=$services->service_id;
         }
         $invoice_data = DB::table('invoices')
         ->select('invoices.price as invoices_price','customer.customer_name','customer.customer_number','invoices.created_at','invoices.invoice_id','customer.customer_id','invoices.role')
         ->join('customer','customer.customer_id','=','invoices.customer_id')
         ->whereIn('invoices.service_id',$service_id)
         ->paginate(10);  
        }
 /* if(isset($main_user_data) && $main_user_data->user_type == 'team_manager'){
       $team_manager_services=TeamManagersServicesModel::where('team_manager_id',$id)->get();
       if(!empty($team_manager_services)){
         $service_id=[];
         foreach($team_manager_services as $services){
          $service_id[]=$services->managers_services_id;
         }
       
         $invoice_data = DB::table('invoices')
         ->select('invoices.price as invoices_price','customer.customer_name','customer.customer_number','invoices.created_at','invoices.invoice_id','customer.customer_id','invoices.role')
         ->join('customer','customer.customer_id','=','invoices.customer_id')
         ->whereIn('invoices.service_id',$service_id)
         ->paginate(10);  
        } 
  }else if(isset($main_user_data) && $main_user_data->user_type == 'customer_success_manager'){
       $customer_success_manager_services=MemberServiceModel::where('member_id',$id)->first();
       $invoice_data = DB::table('invoices')
       ->select('invoices.price as invoices_price','customer.customer_name','customer.customer_number','invoices.created_at','invoices.invoice_id','customer.customer_id','invoices.role')
       ->join('customer','customer.customer_id','=','invoices.customer_id')
       ->where('invoices.user_id','=',$id)
       ->paginate(10);   
 
  }else{
       $invoice_data = DB::table('invoices')
       ->select('invoices.price as invoices_price','customer.customer_name','customer.customer_number','invoices.created_at','invoices.invoice_id','customer.customer_id','invoices.role')
       ->join('customer','customer.customer_id','=','invoices.customer_id')
       ->paginate(10);   
 
  }*/
  return view('admin.dashboard.invoice_list',['admin_data'=>$admin_data,'data'=>$invoice_data,'user_type'=>$user_type]);

  }
  //invoiceList FUNCTION END
  public function viewInvoice($customer_id,$invoice_id){
  $team_id = session('admin');
 // $admin_data = AdminModel::find($team_id);
  $admin_data = self::userDetails($team_id);
  $user_type = self::userType($admin_data->user_type);
  $clients = CustomerModel::find($customer_id);
  $invoice_details = Invoice::find($invoice_id);
  return view('admin.dashboard.view_invoice',['admin_data'=>$admin_data,'clients'=>$clients,'invoice_details'=>$invoice_details,'user_type'=>$user_type]);
  
}
//viewTeamMember FUNCTION START



public function viewTeamMember($team_manager_id){

    $team_id = session('admin');
    $admin_data = self::userDetails($team_id);
    $team_manager_id = Crypt::decrypt($team_manager_id);
    $data = MainUserModel::find($team_manager_id);
    $user_type = $data['user_type'];
    $total_team_member=0;
    $total_invoices_data=0;
    $convert_to_clients=0;
    $total_clients=0;
    $service_data='';
    $user_login_details=0;
    $user_logout=0;
    $team_manager_count = 0;
    $user_role = '';

    $role_services = RoleService::where('member_id',$team_manager_id)->distinct()->get(['service_id']);
        $service_id = [];

      foreach($role_services as $service){
        $service_id[] = $service->service_id;
      }

     $team_manager_count =DB::table('main_user')
     ->join('role_services','role_services.member_id','=','main_user.id')
     ->whereIn('role_services.service_id',$service_id)
     ->count();

     $loginLogoutCount = DB::table('main_user')->join('login_history','login_history.user_id','=','main_user.id')->where('main_user.id',$team_manager_id)->count();
             
     $user_role = Role::where('id',$data['user_type'])->first();
     $service_data=DB::table('services')
     ->join('role_services','role_services.service_id','=','services.service_id')
     ->where('role_services.member_id',$team_manager_id)
     ->distinct()
     ->get(['name']);
     
     $total_clients = DB::table('customer')
          ->select(
              'customer.customer_email',
              DB::raw('MAX(customer.customer_id) as customer_id'),
              DB::raw('MAX(customer.customer_number) as customer_number'),
              DB::raw('MAX(customer.customer_name) as customer_name'),
              DB::raw('MAX(customer.status) as status'),
              DB::raw('MAX(customer.type) as type'),
              DB::raw('MAX(services.service_id) as service_id'),
              DB::raw('MAX(customer.msg) as msg'),
              DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
          )
          ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
          ->groupBy('customer.customer_email') 
          ->whereIn('customer.customer_service_id',$service_id) 
          ->get();
       $user_login_details = DB::table('main_user')
      ->select(DB::raw('DISTINCT DATE(login_history.logged_in_at) as date'))
      ->join('login_history', 'login_history.user_id', '=', 'main_user.id')
      ->where('main_user.id', $team_manager_id)
      ->where('login_history.operation','login')
      ->get();
      $user_logout = DB::table('main_user')
      ->join('login_history', 'login_history.user_id', '=', 'main_user.id')
      ->select(DB::raw('DISTINCT DATE(login_history.logged_in_at) as date'))
      ->select(DB::raw('DISTINCT DATE(login_history.logged_in_at) as date'))
      ->where('main_user.id', $team_manager_id)
      ->where('login_history.operation','logout')
      ->get();
      $total_invoices_data = Invoice::whereIn('service_id',$service_id)->count();


   
    /*if( $data->user_type == 'team_manager' || $data->user_type == 'operation_manager'){
       $team_manager_services = TeamManagersServicesModel::where('team_manager_id',$team_manager_id)->distinct()->get(['managers_services_id']);
        $service_id = [];

      foreach($team_manager_services as $service){
        $service_id[] = $service->managers_services_id;
      }

  
      if($data->user_type == 'operation_manager'){
        $user_role = Role::where('role_name',"operation_manager")->first();

         $team_manager_count =DB::table('main_user')
    //  ->select('main_user.first_name','main_user.last_name','main_user.id','main_user.user_type','main_user.email_address','main_user.phone_number')
     ->join('team_manager_services','team_manager_services.team_manager_id','=','main_user.id')
     ->whereIn('team_manager_services.managers_services_id',$service_id)
     ->where('main_user.user_type','=',"team_manager")
     ->count();
     


      }else{
        $user_role = Role::where('role_name',"team_manager")->first();
        $team_manager_count = 0;
      }

       

    
      $total_team_member = DB::table("member_service")
      ->select('member_service.member_id', DB::raw('MAX(main_user.first_name) as first_name')) 
      ->join("main_user", 'main_user.id', '=', 'member_service.member_id')
      ->whereIn('member_service.member_service_id', $service_id)
      ->groupBy('member_service.member_id')
      ->get();

     $total_clients = DB::table('customer')
          ->select(
              'customer.customer_email',
              DB::raw('MAX(customer.customer_id) as customer_id'),
              DB::raw('MAX(customer.customer_number) as customer_number'),
              DB::raw('MAX(customer.customer_name) as customer_name'),
              DB::raw('MAX(customer.status) as status'),
              DB::raw('MAX(customer.type) as type'),
              DB::raw('MAX(services.service_id) as service_id'),
              DB::raw('MAX(customer.msg) as msg'),
              DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
          )
          ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
          ->groupBy('customer.customer_email') 
          ->whereIn('customer.customer_service_id',$service_id) 
          ->get();
     $total_invoices_data = Invoice::whereIn('service_id',$service_id)->count();
  
     $service_data=DB::table('services')
     ->join('team_manager_services','team_manager_services.managers_services_id','=','services.service_id')
     ->where('team_manager_services.team_manager_id',$team_manager_id)
     ->distinct()
     ->get(['name']);

      $user_login_details = DB::table('main_user')
      ->select(DB::raw('DISTINCT DATE(login_history.logged_in_at) as date'))
      ->join('login_history', 'login_history.user_id', '=', 'main_user.id')
      ->where('main_user.id', $team_manager_id)
      ->where('login_history.operation','login')
      ->get();
      
      $user_logout = DB::table('main_user')
      ->join('login_history', 'login_history.user_id', '=', 'main_user.id')
      ->select(DB::raw('DISTINCT DATE(login_history.logged_in_at) as date'))
      ->select(DB::raw('DISTINCT DATE(login_history.logged_in_at) as date'))
      ->where('main_user.id', $team_manager_id)
      ->where('login_history.operation','logout')
      ->get();
       $loginLogoutCount = DB::table('main_user')->join('login_history','login_history.user_id','=','main_user.id')->where('main_user.id',$team_manager_id)->count();


     
                  
    }else if(isset($data->user_type) && $data->user_type == 'customer_success_manager'){
        $team_manager_count = 0;

        $user_role = Role::where('role_name',"customer_success_manager")->first();
          // $customer_success_manager_services=MemberServiceModel::where('member_id',$data->id)->get();
        $user_login_details = DB::table('main_user')
        ->select(DB::raw('DISTINCT DATE(login_history.logged_in_at) as date'))
        ->join('login_history', 'login_history.user_id', '=', 'main_user.id')
        ->where('main_user.id', $team_manager_id)
        ->where('login_history.operation','login')
        ->get();     
        $user_logout = DB::table('main_user')
        ->select(DB::raw('DISTINCT DATE(login_history.logged_in_at) as date'))
        ->join('login_history', 'login_history.user_id', '=', 'main_user.id')
        ->where('main_user.id', $team_manager_id)
        ->where('login_history.operation','logout')
        ->get();

        $customer_success_manager_services = MemberServiceModel::where('member_id', $data->id)
        ->distinct()
        ->get(['member_service_id']); // Specify the columns you want to be distinct


        $service_id=[];
      if(!empty($customer_success_manager_services)){
           foreach($customer_success_manager_services as $service){
               $service_id[] = $service->member_service_id;
            }
          $total_invoices_data= Invoice::where('user_id',$team_manager_id)->count();
        //  $total_clients= CustomerModel::whereIn('customer_service_id',$service_id)->whereJsonContains('team_member',"$data->id")->count();
         $total_clients = DB::table('customer')
        
          ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
            ->select(
              'customer.customer_email',
              DB::raw('MAX(customer.customer_id) as customer_id'),
              DB::raw('MAX(customer.customer_number) as customer_number'),
              DB::raw('MAX(customer.customer_name) as customer_name'),
              DB::raw('MAX(customer.status) as status'),
              DB::raw('MAX(customer.type) as type'),
              DB::raw('MAX(services.service_id) as service_id'),
              DB::raw('MAX(customer.msg) as msg'),
              DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
          )
          ->groupBy('customer.customer_email') 
          ->whereIn('customer.customer_service_id',$service_id) 
         // ->whereJsonContains('customer.team_member',"$data->id")
          ->get();

          $service_data=DB::table('services')
          ->join('member_service','member_service.member_service_id','=','services.service_id')
          ->where('member_service.member_id',$team_manager_id)
          ->distinct()
          ->get(['name']);


      }
        $loginLogoutCount = DB::table('main_user')->join('login_history','login_history.user_id','=','main_user.id')->where('main_user.id',$team_manager_id)->count();


    }else if(isset($data->user_type) && $data->user_type == 'admin'){
        $team_manager_count = 0;

        $user_role = Role::where('role_name',"admin")->first();
      $total_clients=CustomerModel::all()->count();
      $total_invoices_data=Invoice::all()->count();
      $total_team_member=CustomerModel::where('team_member','!=','null')->count();
        $loginLogoutCount = 0;
    }*/

    return view('admin.dashboard.view_team_member',['admin_data'=>$admin_data,'user_type'=>$user_type,'data'=>$data,'total_team_member'=>$total_team_member,'clients'=>$total_clients, 'convert_to_clients'=>20,'invoice_data'=>$total_invoices_data,'service_data'=>$service_data,'user_login_details'=>$user_login_details,'user_logout'=>$user_logout,'user_role'=>$user_role,'loginLogoutCount'=>$loginLogoutCount,'team_manager_count'=>$team_manager_count]);
}





//viewTeamMember FUNCTION END
public function teamMemberList($manager_id){
  
    $id = session('admin');
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    $team_manager_services=TeamManagersServicesModel::where('team_manager_id',$manager_id)->get();
    $team_member=[];

    if(!empty($team_manager_services)){
            $service_id = [];
            foreach($team_manager_services as $service){
              $service_id[] = $service->managers_services_id;
            }

            $team_member = DB::table("member_service")
            ->select('member_service.member_id', DB::raw('MAX(main_user.first_name) as first_name'),DB::raw('MAX(main_user.last_name) as last_name'),DB::raw('MAX(main_user.phone_number) as phone_number'),DB::raw('MAX(main_user.email_address) as email_address'),DB::raw('MAX(services.name) as name')) 
            ->join("main_user", 'main_user.id', '=', 'member_service.member_id')
            ->join('services','services.service_id','=','member_service.member_service_id')
            ->whereIn('member_service.member_service_id', $service_id)
            ->groupBy('member_service.member_id')
            ->paginate(10);
            //echo '<pre>';
            //print_r($team_member);die;
     }else{
           $team_member=DB::table('main_user')
            ->select('main_user.id as member_id','main_user.first_name as first_name','main_user.last_name as last_name','main_user.phone_number as phone_number','main_user.email_address as email_address','services.name as name')
            ->join('member_service','member_service.member_id','=','main_user.id')
            ->join('services','services.service_id','=','member_service.id')
            ->where('main_user','main_user.user_type','=','customer_success_manager')
            ->paginate(10);
   
     }
   
    return view('admin.dashboard.members_list',['admin_data'=>$admin_data,'team_member'=>$team_member,'user_type'=>$user_type]);
}

//viewTeamMember FUNCTION END
public function teamManagerList($manager_id){
  
    $id = session('admin');
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    $team_manager_services=TeamManagersServicesModel::where('team_manager_id',$manager_id)->get();
    $team_member=[];

    if(!empty($team_manager_services)){
            $service_id = [];
            foreach($team_manager_services as $service){
              $service_id[] = $service->managers_services_id;
            }

            $team_manager =DB::table('main_user')
    //  ->select('main_user.first_name','main_user.last_name','main_user.id','main_user.user_type','main_user.email_address','main_user.phone_number')
     ->join('team_manager_services','team_manager_services.team_manager_id','=','main_user.id')
     ->join('services','services.service_id','=','team_manager_services.managers_services_id')
     ->whereIn('services.service_id',$service_id)
     ->whereIn('team_manager_services.managers_services_id',$service_id)
     ->where('main_user.user_type','=','team_manager')
     ->paginate(10);

            // $team_manager = DB::table("member_service")
            // ->select('member_service.member_id', DB::raw('MAX(main_user.first_name) as first_name'),DB::raw('MAX(main_user.last_name) as last_name'),DB::raw('MAX(main_user.phone_number) as phone_number'),DB::raw('MAX(main_user.email_address) as email_address'),DB::raw('MAX(services.name) as name')) 
            // ->join("main_user", 'main_user.id', '=', 'member_service.member_id')
            // ->join('services','services.service_id','=','member_service.member_service_id')
            // ->whereIn('member_service.member_service_id', $service_id)
            // ->groupBy('member_service.member_id')
            // ->paginate(10);

            //echo '<pre>';
            //print_r($team_member);die;
     }else{
          //  $team_member=DB::table('main_user')
          //   ->select('main_user.id as member_id','main_user.first_name as first_name','main_user.last_name as last_name','main_user.phone_number as phone_number','main_user.email_address as email_address','services.name as name')
          //   ->join('member_service','member_service.member_id','=','main_user.id')
          //   ->join('services','services.service_id','=','member_service.id')
          //   ->where('main_user','main_user.user_type','=','customer_success_manager')
          //   ->paginate(10);
   
     }
   
    return view('admin.dashboard.members_list',['admin_data'=>$admin_data,'team_member'=>$team_manager,'user_type'=>$user_type]);
}



public function showClientsList($manager_id){
    $id = session('admin');
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    $main_user_data =MainUserModel::find($manager_id);
    $role_service=RoleService::where('member_id',$manager_id)->get();
      if(!empty($role_service)){
          $service_id = [];
            foreach($role_service as $service){
              $service_id[] = $service->service_id;
            }
            $clients = DB::table('customer')
            ->select(
                'customer.customer_email',
                DB::raw('MAX(customer.customer_id) as customer_id'),
                DB::raw('MAX(customer.customer_number) as customer_number'),
                DB::raw('MAX(customer.customer_name) as customer_name'),
                DB::raw('MAX(customer.status) as status'),
                DB::raw('MAX(customer.type) as type'),
                DB::raw('MAX(customer.city) as city'),
                DB::raw('MAX(customer.state) as state'),
                DB::raw('MAX(services.service_id) as service_id'),
                DB::raw('MAX(customer.msg) as msg'),
                DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
            )
            ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
            ->groupBy('customer.customer_email') 
            ->whereIn('customer.customer_service_id',$service_id)
            ->paginate(10);
      }
         
     
   /* if(isset($main_user_data) && $main_user_data->user_type=='customer_success_manager'){
      $customer_service=MemberServiceModel::where('member_id',$manager_id)->get();
      if(!empty($customer_service)){
          $service_id = [];
            foreach($customer_service as $service){
              $service_id[] = $service->member_service_id;
            }
          
           $clients = DB::table('customer')
            ->select(
                'customer.customer_email',
                DB::raw('MAX(customer.customer_id) as customer_id'),
                DB::raw('MAX(customer.customer_number) as customer_number'),
                DB::raw('MAX(customer.customer_name) as customer_name'),
                DB::raw('MAX(customer.status) as status'),
                DB::raw('MAX(customer.type) as type'),
                DB::raw('MAX(customer.city) as city'),
                DB::raw('MAX(customer.state) as state'),
                DB::raw('MAX(services.service_id) as service_id'),
                DB::raw('MAX(customer.msg) as msg'),
                DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
            )
            ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
            ->groupBy('customer.customer_email') 
            ->whereIn('customer.customer_service_id',$service_id)
           // ->whereJsonContains('customer.team_member',$manager_id)
            ->paginate(10);

         
         
      }
    }else if(isset($main_user_data) && $main_user_data->user_type=='team_manager' || $main_user_data->user_type=='operation_manager'){
       $team_manager_services=TeamManagersServicesModel::where('team_manager_id',$manager_id)->get();
        if(!empty($team_manager_services)){
           $service_id = [];
            foreach($team_manager_services as $service){
              $service_id[] = $service->managers_services_id;
            }
         
            $clients = DB::table('customer')
            ->select(
                'customer.customer_email',
                DB::raw('MAX(customer.customer_id) as customer_id'),
                DB::raw('MAX(customer.customer_number) as customer_number'),
                DB::raw('MAX(customer.customer_name) as customer_name'),
                DB::raw('MAX(customer.status) as status'),
                DB::raw('MAX(customer.type) as type'),
                    DB::raw('MAX(customer.city) as city'),
                DB::raw('MAX(customer.state) as state'),
                DB::raw('MAX(services.service_id) as service_id'),
                DB::raw('MAX(customer.msg) as msg'),
                DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
            )
            ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
            ->groupBy('customer.customer_email') 
            ->whereIn('customer.customer_service_id',$service_id)
            ->paginate(10);
      
   
        }
    }else{
         $clients=DB::table('customer')
            ->select('customer.*','services.name as service_name')
            ->join('services','services.service_id','=','customer.customer_service_id')
            ->paginate(10);
    
    }*/
    return view('admin.dashboard.clients_list',['admin_data'=>$admin_data,'clients'=>$clients,'user_type'=>$user_type]);
}
public function viewMember($member_id){
    $team_id = session('admin');
    $admin_data = AdminModel::find($team_id);
    $member_id =   Crypt::decrypt($member_id);
    $member_data = TeamMember::find($member_id);
    $services = Service::find($member_data['team_service']);
    $invoice_data=Invoice::where('service_id','=',$member_data['team_service'])->where('team_member_id','=',$member_data['team_member_id'])->count();
    $convert_to_clients =PaidCustomer::where('team_member_id','=',$member_id)->where('role','=','team_member')->count();
    return view('admin.dashboard.view_member',['admin_data'=>$admin_data,'data'=>$member_data,'services_data'=>$services,'invoice_data'=>$invoice_data,'convert_to_clients'=>$convert_to_clients]);
}
 public function memberInvoiceList($team_member_id){
    $admin_id = session('admin');
 // $admin_data = AdminModel::find($admin_id);
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);   
    $member_data=TeamMember::find($team_member_id);
    return view('admin.dashboard.member_invoice_list',['admin_data'=>$admin_data,'data'=>$invoice_data,'member_data'=>$member_data,'user_type'=>$user_type]);
  }
 public function manager_convert_to_clients_list($manager_id){
     $team_id = session('admin');
     $admin_data = AdminModel::find($team_id);
     $data = UserModel::find($manager_id);
     $client_data = DB::table('customer')
     ->select('customer.customer_id','customer.customer_name','customer.customer_number','customer.customer_email','customer.msg')
     ->join('paid_customer','paid_customer.customer_id','=','customer.customer_id')
     ->where('paid_customer.team_manager_id',$manager_id)
     ->where('paid_customer.role','team_manager')
     ->get();
    return view('admin.dashboard.manager_convert_to_client_list',['admin_data'=>$admin_data,'client_data'=>$client_data]);
 }
 public function member_convert_to_clients_list($member_id){
     $team_id = session('admin');
     $admin_data = AdminModel::find($team_id);
     $data = TeamMember::find($member_id);
     $client_data = DB::table('customer')
     ->select('customer.customer_id','customer.customer_name','customer.customer_number','customer.customer_email','customer.msg')
     ->join('paid_customer','paid_customer.customer_id','=','customer.customer_id')
     ->where('paid_customer.team_member_id',$member_id)
     ->where('paid_customer.role','team_member')
     ->get();
    return view('admin.dashboard.member_convert_to_client_list',['admin_data'=>$admin_data,'client_data'=>$client_data]);
 }
 public function viewCustomers(){
     $team_id = session('admin');
     $admin_data = AdminModel::find($team_id);
     $client_data =DB::table('customer')
     ->select('customer.customer_id','customer.customer_name','customer.customer_email','customer.customer_number','customer.msg')
     ->join('paid_customer','paid_customer.customer_id','=','customer.customer_id')
     ->get();
     return view('admin.dashboard.view_customers',['admin_data'=>$admin_data,'client_data'=>$client_data]);
 }
 public function viewManagers(){
      $id = session('admin');
      $admin_data = self::userDetails($id);
      $user_type = self::userType($admin_data->user_type);
      $contact_data = DB::table('main_user')
       ->select('main_user.*')
       ->where('main_user.user_type','team_manager')
       ->orderBy('main_user.id', 'DESC')
       ->get();
      return view('admin.dashboard.view_managers',['admin_data'=>$admin_data,'data'=>$contact_data,'user_type'=>$user_type]);
}
public function viewManagerDetails($team_manager_id){
    $team_id = session('admin');
    $admin_data = self::userDetails($team_id);
    $team_manager_id =   Crypt::decrypt($team_manager_id);
    $data = MainUserModel::find($team_manager_id);
    $user_type = self::userType($data->user_type);
    
    //$data = UserModel::find($team_manager_id);
    //$services = Service::find($data['service_id']);
   // $total_team_member = TeamMember::where('team_service',$data['service_id'])->count();
   // $clients=CustomerModel::where('team_member','=',$data['user_id'])->where('status','=',1)->count();
   // $invoice_data=Invoice::where('service_id','=',$data['service_id'])->where('team_manager_id','=',$data['user_id'])->count();
   // $convert_to_clients=PaidCustomer::where('team_manager_id',$team_manager_id)->where('role','team_manager')->count();
   
   return view('admin.dashboard.view_manager_details',['data'=>$data,'admin_data'=>$admin_data,'user_type'=>$user_type]);
}
public function viewMembers(){
      $id = session('admin');
      $admin_data = self::userDetails($id);
      $user_type = self::userType($admin_data->user_type);
      $contact_data = DB::table('main_user')
       ->select('main_user.*')
       ->where('main_user.user_type','customer_success_manager')
       ->orderBy('main_user.id', 'DESC')
       ->get();
      return view('admin.dashboard.view_team_member_lists',['admin_data'=>$admin_data,'data'=>$contact_data,'user_type'=>$user_type]);
}
public function viewOperationsManagers(){
      $id = session('admin');
      $admin_data = self::userDetails($id);
      $user_type = self::userType($admin_data->user_type);
      $contact_data = DB::table('main_user')
       ->select('main_user.*')
       ->where('main_user.user_type','operation_manager')
       ->orderBy('main_user.id', 'DESC')
       ->get();
      return view('admin.dashboard.view_operations_managers',['admin_data'=>$admin_data,'data'=>$contact_data,'user_type'=>$user_type]);
}
public function addLead(){
      $id = session('admin');
      $admin_data = self::userDetails($id);
      $user_type = self::userType($admin_data->user_type);
      $all_services = Service::where('name','!=','uncategorized')->get();
    return view('admin.dashboard.add_lead',['admin_data'=>$admin_data,'user_type'=>$user_type,'all_services'=>$all_services]);
}


 public function leadAdd(Request $request){

      $service_id =$request->customer_service_id;
      if(empty($service_id)){
        $service_id = ['14'];
      }

          $type=$request->type;
           $phone= $request->phone;
           $country_code = $request->country_code;
           $customer_number = $country_code.$phone;
           $first_name = $request->first_name;
           $middle_name =$request->middle_name;
           $last_name=$request->last_name;
            $email = $request->email;
            $msg = $request->msg;
            $dob=$request->dob;
            $address=$request->address;
            $city=$request->city;
            $state=$request->state;
            $zip=$request->zip;
            $ssn=$request->ssn;
            $msg=$request->msg;

          $email_address = $request->email_address;
          $fax = $request->fax;
         $contact_number = $request->contact_number;
        
        // $email_address = $request->email_address;
         $business_name=$request->business_name;
         $industry=$request->industry;
         $business_phone_no=$request->business_phone_no;
        $customer_number = $business_phone_no;

        $business_email=$request->business_email;
        $customer_email = $business_email;
        $ein=$request->ein;
        $business_address=$request->business_address;
        $business_city=$request->business_city;
        $business_state=$request->business_state;
        $business_zip=$request->business_zip;
        $business_title=$request->business_title;
        $point_of_contact=$request->point_of_contact;
        $msg=$request->msg;

        if($phone!="" ){
          $check = CustomerModel::where('customer_number',$phone)->first();
               if($check){
                    return self::toastr(false,"Number already exist","error","Error");
              }
        }
        
          if($email !="") {
             $check = CustomerModel::where('customer_email',$email)->first();
               if($check){
                    return self::toastr(false,"Email already exist","error","Error");
              }
        }
 
           $phone= $request->phone;
           $country_code = $request->country_code;
           $customer_number = $country_code.$phone;
           $first_name = $request->first_name;
           $middle_name =$request->middle_name;
           $last_name=$request->last_name;
            $email = $request->email;
            $msg = $request->msg;
            $dob=$request->dob;
            $address=$request->address;
            $city=$request->city;
            $state=$request->state;
            $zip=$request->zip;
            $ssn=$request->ssn;
            $msg=$request->msg;

            if(!empty($middle_name)){
               $customer_name=$first_name.' ' .$middle_name.' '.$last_name;
             }else{
               $customer_name=$first_name.' '.$last_name;
             }

               $check = CustomerModel::where('customer_email',$customer_email)
               ->orWhere('customer_number',$customer_number)->first();
               if($check){
             return self::toastr(false,"Number or Email already exist","error","Error");
          }
                $individual_details = new CustomerModel;
                $individual_details->customer_name = $customer_name;
                $individual_details->customer_number = $customer_number ;
                $individual_details->customer_email = $email ;
                // $individual_details->customer_service_id = json_encode($service_id);
                $individual_details->type=$type;
                $individual_details->first_name=$first_name;
                $individual_details->middle_name=$middle_name;
                $individual_details->last_name=$last_name;
                $individual_details->dob=$dob;
                $individual_details->address=$address;
                $individual_details->city=$city;
                $individual_details->state=$state;
                $individual_details->zip=$zip;
                $individual_details->ssn=$ssn;
                $individual_details->msg=$msg;
                
                $email_address = $request->email_address;
                $fax = $request->fax;
                $contact_number = $request->contact_number;
                
                $business_name=$request->business_name;
                $industry=$request->industry;
                $business_phone_no=$request->business_phone_no;
                $customer_number = $business_phone_no;

                $business_email=$request->business_email;
                $customer_email = $business_email;
                $ein=$request->ein;
                $business_address=$request->business_address;
                $business_city=$request->business_city;
                $business_state=$request->business_state;
                $business_zip=$request->business_zip;
                $business_title=$request->business_title;
                $point_of_contact=$request->point_of_contact;
                $save = $individual_details->save();
      if($save){
        foreach ($service_id as $key => $value) {
      $new = new CustomerServiceModel();
      $new->customer_main_id = $individual_details->customer_id;
      $new->customer_service_id = $value;
      $new ->save();
        }
         return self::toastr(true,"Lead Add Successfull","success","Success");
      }else{
         return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      }
      
    }

    
  public function viewLeads(){
      $id = session('admin');
      $admin_data = self::userDetails($id);
      $service = Service::orderBy('service_id','DESC')->get();

      if($admin_data->user_type == 'admin'){
       
     $leads_data = DB::table("customer")
    ->join("customer_service", 'customer_service.customer_main_id', '=', 'customer.customer_id')
    ->join("services", 'services.service_id', '=', 'customer_service.customer_service_id')
    ->select(
        'customer.customer_email',
        DB::raw('MAX(customer.customer_id) as customer_id'),
        DB::raw('MAX(customer.customer_number) as customer_number'),
        DB::raw('MAX(customer.customer_name) as customer_name'),
        DB::raw('MAX(customer.status) as status'),
        DB::raw('MAX(customer.city) as city'),
        DB::raw('MAX(customer.state) as state'),
        DB::raw('MAX(customer.type) as type'),
        DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names')
    )
    ->groupBy('customer.customer_email') // Add groupBy to group the results properly
    ->paginate(10);

          
        }else{
            $role_services=RoleService::where('member_id',$admin_data->user_id)->get();

            if(!empty($role_services)){
               $service_id = [];
                foreach($role_services as $services){
                  $service_id[] = $services->service_id;
                }

                $leads_data = DB::table('customer')
                ->select(
                    'customer.customer_email',
                    DB::raw('MAX(customer.customer_id) as customer_id'),
                    DB::raw('MAX(customer.customer_number) as customer_number'),
                    DB::raw('MAX(customer.customer_name) as customer_name'),
                    DB::raw('MAX(customer.status) as status'),
                    DB::raw('MAX(customer.city) as city'),
                    DB::raw('MAX(customer.state) as state'),
                    DB::raw('MAX(customer.type) as type'),
                    DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
                )
                ->leftjoin('services', 'services.service_id', '=', 'customer.customer_service_id')
                ->groupBy('customer.customer_email') 
                ->whereIn('customer.customer_service_id',$service_id)
                ->paginate(10);
            }
         
        }

      return view('admin.dashboard.view_leads',['services'=>$service,'admin_data'=>$admin_data,'data'=>$leads_data]);
 }
 //chatShow FUNCTION START
  public function chatShow($customer_id){
     $id = session('admin');
     $admin_data = self::userDetails($id);
     $user_type = self::userType($admin_data->user_type);
     $customer_id =   Crypt::decrypt($customer_id);
     $customers = DB::table('customer')
     
     ->join('remark','remark.customer_id','=','customer.customer_id')
     ->join('main_user','main_user.id','=','remark.user_id')
     ->where('customer.customer_id','=',$customer_id)
     ->get(['remark.*','customer.customer_id','customer.customer_service_id','customer.customer_name','main_user.user_type','main_user.first_name','main_user.last_name']);
     
    //  echo '<pre>';
    //  print_r($customers);die;
     
     $clients = CustomerModel::find($customer_id);
     $service_data = Service::find($clients->customer_service_id);

     
     return view('admin.dashboard.chat',['admin_data'=>$admin_data,'data'=>$customers,'customer'=>$clients,'user_type'=>$user_type,'service_data'=>$service_data]);
  }
//chatShow FUNCTION END 
//Remark FUNCTION START
public function remarks(Request $request){
  
  $customer_id = $request->customer_id;
  $user_id = $request->user_id;
  $remark =$request->remark;
  $role=$request->role;

  $remark_details = new RemarkModel;
  $remark_details->customer_id =$customer_id;
  $remark_details->user_id=$user_id;
  $remark_details->remark=$remark;
  $remark_details->role=$role;

  $save = $remark_details->save();
      if($save){
          return self::toastr(true,"Remark Added","success","Success");
      }else{
         return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      }

}
//Remark FUNCTION END
//callPage FUNCTION START
public function callPage($customer_id){
   $id = session('admin');
   $admin_data = self::userDetails($id);
   $user_type = self::userType($admin_data->user_type);
   $customer_id = decrypt($customer_id);
   $user_data = CustomerModel::find($customer_id);
   $number = $user_data->customer_number;
   $name = $user_data->customer_name;
  return view('admin.dashboard.call',['admin_data'=>$admin_data,'id'=>$customer_id,'call_number'=>$number,'name'=>$name,'user_type'=>$user_type]);
}
//callPage FUNCTION END
//  THIS IS emailText FUNCTION 
public function emailText($customer_id){
   $id = session('admin');
   $admin_data = self::userDetails($id);
   $user_type = self::userType($admin_data->user_type);
   $customer_id = decrypt($customer_id);
  return view('admin.dashboard.email_text',['admin_data'=>$admin_data,'id'=>$customer_id,'user_type'=>$user_type]);
}
//  THIS IS emailText FUNCTION 
// THIS IS emailSendToClient FUNCTION 
public function emailSendToClient(Request $request){
   $id = $request->customer_id;
   $msg = $request->editor2;
    $email_data = CustomerModel::find($id);
    $email =$email_data->customer_email;
    // echo $email;
    // die();
    if($msg==""){
   return self::toastr(false,' Text Field is blank , Please Text email','error','Error');
    }
   $data = ['msg'=>$msg];
    $user['to'] = $email;
  $send =   Mail::send('admin.dashboard.mail',$data,function($messages)use($user)
    {$messages->to($user['to']);
      $messages->subject('Business Email');
    });
  if($send){
    $save = new EmailModel;
    $save->email_admin = session('admin');
    $save->email_customer = $id;
    $save->email_text = $msg;
    $save->save();
   return self::toastr(true,'Email Send Successfull','success','Success');
  }else{
   return self::toastr(false,'Please Try again Later','error','Error');
  }
  
  
}
// THIS IS emailSendToClient FUNCTION 
//  THIS IS messageText FUNCTION 
public function messageText($customer_id){
   $id = session('admin');
   $admin_data = self::userDetails($id);
   $user_type = self::userType($admin_data->user_type);
   $customer_id = decrypt($customer_id);
  return view('admin.dashboard.text_msg',['admin_data'=>$admin_data,'id'=>$customer_id,'user_type'=>$user_type]);
}
//  THIS IS messageText FUNCTION 
// THIS IS A SEND_SMS FUNCTION 
public function sendSms(Request $request){

     
        $twilioNumber = "+19367554277";
    $sid    = "AC6b8cceac1de333558bf646b0a3900669";
    $token  = "03113f0ead6134aa839d8be78b965cd8";
    $twilio = new Client($sid, $token);

        
  // THIS IS API GET VARIABLE        
        $message = $request->input('message');
        $customer_id = $request->customer_id;

        $customer_details  = CustomerModel::find($customer_id);
        $number = $customer_details->customer_number;


        $status = $twilio->messages->create(
            $number,
            [
                'from' => $twilioNumber,
                'body' => $message,
            ]
            
        );


        if($status){
          $save = new MessageModel;
          $save -> team_member_id = session('admin');
          $save -> customer_msg_id = $customer_id;
          $save -> message = $message;
          $save->save();
          return self::toastr(true,'Message Send Successfull','success','Success');

        }else{
          return self::toastr(false,'Message Not Sending','error','Error');

        }

      }
// THIS IS A SEND_SMS FUNCTION  
//createInvoice Function Start
public function createInvoice($customer_id){

  $id = session('admin');
  $admin_data = self::userDetails($id);
  $data = CustomerModel::find($customer_id);
  
  // $package_id=explode(',',$data->package_id);
  // $package_data =Package::whereIn('package_id',$package_id)->get();

  $package_data=DB::table("packages")
  ->join("customer_package","customer_package.customer_package_id","=","packages.package_id")
  ->where("customer_package.customer_main_id",$data->customer_id)
  ->get();

  
 return view('admin.dashboard.create_invoice',['admin_data'=>$admin_data,'data'=>$data,'package_data'=>$package_data]);
}
//createInvoice Function End
//invoiceAdd Function Start
public function invoiceAdd(Request $request){
  $customer_package_tem_id = $request->customer_package_tem_id;
  $customerId = $request->customerId;
  $id = session("admin");
 
   $invoiceExist  = Invoice::where("customer_package_main_id",$customer_package_tem_id)->first();
   if($invoiceExist){
    return self::toastr(false,'This Package Already Exist','error','Error');
    }else{
      $save = new Invoice; 
      $save->customer_package_main_id = $customer_package_tem_id;
      $save->user_id = $id;
      $save->customer_id = $customerId;
      $save->save();

      return self::toastr(true,$save->customer_package_main_id,'success','Success');
      }
    

  

      // $date = $request->date;
      // $price = $request->price;
      // $description=$request->description;
      // $customer_id=$request->customer_id;
      // $user_id=$request->user_id;
      // $role=$request->role;
      // $service_id=$request->service_id;
      // $custom=$request->custom;
      // $package_id=$request->package;
      // $custom_title=$request->title;
      // $invoice_id="INV-".rand(4, 9999);

      
      // $invoice_details = new Invoice;
      // $invoice_details->price = $price;
      // $invoice_details->date = $date;
      // $invoice_details->customer_id = $customer_id;
      // $invoice_details->description = $description;
      // $invoice_details->user_id = $user_id;
      // $invoice_details->role = $role;
      // $invoice_details->service_id=$service_id;
      // $invoice_details->title=$custom_title;
      // if($package_id !=''){
      //  $invoice_details->package_id=$package_id;
      // }else{
      //  $invoice_details->package_id=$custom;

      // }
      // $invoice_details->invoice_unique_id=$invoice_id;
      // $save = $invoice_details->save();

      // $invoice_id=$invoice_details->invoice_id;


      // if($save){
      //    return self::toastr(true,$invoice_id,"success","Success");

      // }else{
      //    return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      // }
      
}

//invoiceAdd Function End
//invoice2 Function Start
public function invoice2($customer_package_tem_id){
  // die;
  $id = session('admin');
  $admin_data = self::userDetails($id);

  $invoice_details = DB::table("invoices")
  ->join("customer_package","customer_package.customer_package_tem_id",'=','invoices.customer_package_main_id')
  ->join("packages","packages.package_id","=","customer_package.customer_package_id")
  ->join("customer","customer.customer_id","=","customer_package.customer_main_id")
  ->where('customer_package.customer_package_tem_id',$customer_package_tem_id)
  ->first();

return view('admin.dashboard.invoice',['admin_data'=>$admin_data,'invoice_details'=>$invoice_details]);
}
//invoice2 Function End
//convertToClient Function Start
public function convertToClient(Request $request){
      $customer_id = $request->customer_id;
      $user_id = $request->user_id;
      $role = $request->role;
      $paid_customer_details = new PaidCustomer;
      $paid_customer_details->customer_id = $customer_id;
      $paid_customer_details->user_id = $user_id;
      $paid_customer_details->role = $role;
      $save = $paid_customer_details->save();
      $customer_details = CustomerModel::find($customer_id);
      $customer_details->status = 0;
      $save_status=$customer_details->save();

      if($save){
         return self::toastr(true,"Converted To Client ","success","Success");

      }else{
         return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      }
      
}
//convertToClient Function End
//viewClients Function Start
public function viewClients(){
      $id = session('admin');
      $admin_data = self::userDetails($id);
      $user_type = self::userType($admin_data->user_type);
      if($admin_data->user_type == 'admin'){
      $client_data = DB::table('customer')
            ->select(
                'customer.customer_email',
                DB::raw('MAX(customer.customer_id) as customer_id'),
                DB::raw('MAX(customer.customer_number) as customer_number'),
                DB::raw('MAX(customer.customer_name) as customer_name'),
                DB::raw('MAX(customer.status) as status'),
                DB::raw('MAX(customer.paid_customer) as paid_customer'),
                DB::raw('MAX(customer.customer_service_id) as customer_service_id'),
                DB::raw('MAX(customer.msg) as msg'),
                DB::raw('MAX(customer.team_member) as team_member'),
                DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
            )
            ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
            ->groupBy('customer.customer_email') 
            ->where('customer.paid_customer',1)
            ->paginate(10);
      }else{
         $role_services=RoleService::where('member_id',$admin_data->user_id)->get();
            if(!empty($role_services)){
               $service_id = [];
                foreach($role_services as $service){
                  $service_id[] = $service->service_id;
                }
                  $client_data = DB::table('customer')
                    ->select(
                        'customer.customer_email',
                        DB::raw('MAX(customer.customer_id) as customer_id'),
                        DB::raw('MAX(customer.customer_number) as customer_number'),
                        DB::raw('MAX(customer.customer_name) as customer_name'),
                        DB::raw('MAX(customer.status) as status'),
                        DB::raw('MAX(customer.paid_customer) as paid_customer'),
                        DB::raw('MAX(customer.customer_service_id) as customer_service_id'),
                        DB::raw('MAX(customer.msg) as msg'),
                        DB::raw('MAX(customer.team_member) as team_member'),
                        DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
                    )
                    ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
                    ->groupBy('customer.customer_email') 
                    ->where('customer.paid_customer',1)
                    ->whereIn('customer.customer_service_id',$service_id)
                    ->paginate(10);
          
              
            }

      }  
      /*if($admin_data->user_type == 'admin'){
          
            $client_data = DB::table('customer')
            ->select(
                'customer.customer_email',
                DB::raw('MAX(customer.customer_id) as customer_id'),
                DB::raw('MAX(customer.customer_number) as customer_number'),
                DB::raw('MAX(customer.customer_name) as customer_name'),
                DB::raw('MAX(customer.status) as status'),
                DB::raw('MAX(customer.paid_customer) as paid_customer'),
                DB::raw('MAX(customer.customer_service_id) as customer_service_id'),
                DB::raw('MAX(customer.msg) as msg'),
                DB::raw('MAX(customer.team_member) as team_member'),
                DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
            )
            ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
            ->groupBy('customer.customer_email') 
            ->where('customer.paid_customer',1)
            ->paginate(10);
        
      }else if($admin_data->user_type == 'customer_success_manager'){
            $client_data = DB::table('customer')
            ->select(
                'customer.customer_email',
                DB::raw('MAX(customer.customer_id) as customer_id'),
                DB::raw('MAX(customer.customer_number) as customer_number'),
                DB::raw('MAX(customer.customer_name) as customer_name'),
                DB::raw('MAX(customer.status) as status'),
                DB::raw('MAX(customer.paid_customer) as paid_customer'),
                DB::raw('MAX(customer.customer_service_id) as customer_service_id'),
                DB::raw('MAX(customer.msg) as msg'),
                DB::raw('MAX(customer.team_member) as team_member'),
                DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
            )
            ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
            ->groupBy('customer.customer_email') 
            ->where('customer.paid_customer',1)
            ->whereJsonContains('customer.team_member',"$admin_data->id")
            ->paginate(10);
  
      }else if($admin_data->user_type == 'team_manager'  || $admin_data->user_type == 'operation_manager'){
            $team_manager_services=TeamManagersServicesModel::where('team_manager_id',$admin_data->user_id)->get();
            if(!empty($team_manager_services)){
               $service_id = [];
                foreach($team_manager_services as $service){
                  $service_id[] = $service->managers_services_id;
                }
                  $client_data = DB::table('customer')
                    ->select(
                        'customer.customer_email',
                        DB::raw('MAX(customer.customer_id) as customer_id'),
                        DB::raw('MAX(customer.customer_number) as customer_number'),
                        DB::raw('MAX(customer.customer_name) as customer_name'),
                        DB::raw('MAX(customer.status) as status'),
                        DB::raw('MAX(customer.paid_customer) as paid_customer'),
                        DB::raw('MAX(customer.customer_service_id) as customer_service_id'),
                        DB::raw('MAX(customer.msg) as msg'),
                        DB::raw('MAX(customer.team_member) as team_member'),
                        DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
                    )
                    ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
                    ->groupBy('customer.customer_email') 
                    ->where('customer.paid_customer',1)
                    ->whereIn('customer.customer_service_id',$service_id)
                    ->paginate(10);
            }
      }*/
     // echo '<pre>';
     // print_r($client_data);die;
      return view('admin.dashboard.view_clients',['admin_data'=>$admin_data,'data'=>$client_data,'user_type'=>$user_type]);
 }


// public function viewClients(){
//       $id = session('admin');
//       $admin_data = self::userDetails($id);
//       $user_type = self::userType($admin_data->user_type);
      
//       $client_data = DB::table('customer')
//       ->join('services','services.service_id','=','customer.customer_service_id')
//       ->where('customer.paid_customer',1)
//       ->get();
//       echo "<pre>";
//       print_r($client_data);
//       die;
//       return view('admin.dashboard.view_clients',['admin_data'=>$admin_data,'data'=>$client_data,'user_type'=>$user_type]);
//  }
 //viewClients Function End
 
 //viewInvoiceList Function Start
 
  public function viewInvoiceList(){
     $id = session('admin');
     $admin_data = self::userDetails($id);
     $user_type = self::userType($admin_data->user_type);

     if($admin_data->user_type == 'admin'){

      $invoice_data = DB::table('main_user')
      ->select('main_user.first_name as user_first_name','main_user.last_name as user_last_name','invoices.price as invoices_price','customer.customer_name','customer.customer_number','invoices.created_at','invoices.invoice_id','customer.customer_id')
      ->join('invoices','invoices.user_id','=','main_user.id')
      ->join('customer','customer.customer_id','=','invoices.customer_id')
      ->paginate(10);
     }else{
        $invoice_data = DB::table('main_user')
        ->select('main_user.first_name as user_first_name','main_user.last_name as user_last_name','invoices.price as invoices_price','customer.customer_name','customer.customer_number','invoices.created_at','invoices.invoice_id','customer.customer_id')
        ->join('invoices','invoices.user_id','=','main_user.id')
        ->join('customer','customer.customer_id','=','invoices.customer_id')
        ->where('main_user.id',$admin_data->user_id)
        ->paginate(10);
     }
    return view('admin.dashboard.view_invoice_list',['admin_data'=>$admin_data,'data'=>$invoice_data,'user_type'=>$user_type]);
 } 

 
 //viewInvoiceList Function End
 //showInvoice Function Start
 public function showInvoice($customer_id,$invoice_id){
    $id = session('admin');
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    $clients = CustomerModel::find($customer_id);
    $invoice_details = Invoice::find($invoice_id);
    $package_details=DB::table('packages')->select('packages.title')->join('customer','customer.package_id','=','packages.package_id')->where('customer.customer_id',$customer_id)->first();
    return view('admin.dashboard.show_invoice',['admin_data'=>$admin_data,'clients'=>$clients,'invoice_details'=>$invoice_details,'user_type'=>$user_type,'package_details'=>$package_details]);
}
 //showInvoice Function End
//emailTemplate FUNCTION START
public function emailTemplate(){
   $id = session('admin');
   $admin_data = self::userDetails($id);
   $user_type = self::userType($admin_data->user_type);
   return view('admin.dashboard.add_email_template',['admin_data'=>$admin_data,'user_type'=>$user_type]);
}
//emailTemplate FUNCTION END
//sendEmailTemplate FUNCTION START
public function sendEmailTemplate(Request $request){
   $main_user_id = $request->main_user_id;
   $service_id = $request->service_id;
   $mail_txt = $request->editor2;
   $email_title = $request->email_title;
   if($mail_txt==""){
      return self::toastr(false,' Text Field is blank , Please Text email','error','Error');
   }
   $email_template_details = new  EmailTemplate;
   $email_template_details->email_text = $mail_txt;
   $email_template_details->team_manager_id = $main_user_id;
   $email_template_details->service_id = $service_id;
   $email_template_details->email_title = $email_title;
   $save=$email_template_details->save();
      if($save){
          return self::toastr(true,"Email Template Added","success","Success");
      }else{
         return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      }

}
//sendEmailTemplate FUNCTION ENDS
//allEmailTemplate FUNCTION START
public function allEmailTemplate(){
   $id = session('admin');
   $admin_data = self::userDetails($id);
   $user_type = self::userType($admin_data->user_type);
   $template_data =EmailTemplate::where('team_manager_id',$admin_data->id)->get();
   return view('admin.dashboard.all_email_template',['admin_data'=>$admin_data,'data'=>$template_data,'user_type'=>$user_type]);
}
//allEmailTemplate FUNCTION END
public function savePackage(Request $request){
      $title = $request->title;
      $price = $request->price;
      $service_id  = $request->service_id;
      $subservices  = $request->subservices;

     if(Package::where('title',$title)->first()){
         return self::toastr(false,"Package Title Already Exit","error","Error");
     }
     if(!empty($subservices)){
      foreach ($subservices as $key => $value) {
         $package_details = new Package;
         $package_details->title = $title;
         $package_details->price = $price;
         $package_details->service_id =$service_id;
         $package_details->subservice_id =$value;
         $save = $package_details->save();
     
      }
     }else{
         $package_details = new Package;
         $package_details->title = $title;
         $package_details->price = $price;
         $package_details->service_id =$service_id;
         $save = $package_details->save();
     
     }
        if($save){
          return self::toastr(true,"Package Added","success","Success");
        }else{
          return self::toastr(false,"Sorry , Technical Issue..","error","Error");
        }
  }
   public function updatePackage(Request $request){
      $title = $request->title;
      $price = $request->price;
      $package_id = $request->package_id;
      $service_id = $request->service_id;
      $subservices = $request->subervice_id;
     
      $package_details = Package::find($package_id);
      $package_details->title = $title;
      $package_details->price = $price;
      $package_details->service_id  = $service_id;  
      $package_details->subservice_id =$subservices;
      $save = $package_details->save();
     
      if($save){
         return self::toastr(true,"Package Details Updated Successfull","success","Success");
      }else{
         return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      }
  } 
  public function deletePackage(Request $request){  
    $id = $request->id;
    $delete = Package::find($id)->delete();
    if($delete){
       return self::toastr(true,'Deleted Successfull','success','Success');
    }else{
      return self::toastr(false,'Technical Issue','error','Error');
        
    }
  }
  public function viewAssignClient($customer_id){

    $id = session('admin');
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    $customer_details = CustomerModel::find($customer_id);
    


    $customer_service_id = $customer_details->customer_service_id;
    
    $main_user_id = json_decode($customer_details->team_member);

     
    $data = DB::table('main_user')
    ->select('main_user.first_name', 'main_user.last_name')
    ->whereIn('main_user.id',$main_user_id)
    ->get();
    
   // $services_data = Service::find($customer_details->customer_service_id);
    $services_data = DB::table('customer')
        ->select(
            'customer.customer_email',
            DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
        )
        ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
        ->groupBy('customer.customer_email')
        ->where('customer.customer_email',$customer_details->customer_email) 
        ->get();
    
  $invoices = Invoice::where("customer_id",$customer_id)->count();

    $managers = DB::table("team_manager_services")->join("services",'services.service_id','=',"team_manager_services.managers_services_id")->where("team_manager_services.managers_services_id",$customer_service_id)->get();

   $manager_data = collect();

foreach ($managers as $key => $value) {
    $manager = DB::table("main_user")->join("permission",'permission.user_id','=','main_user.id')->where("id", $value->team_manager_id)->get();
    $manager_data = $manager_data->merge($manager);
}


    return view('admin.dashboard.view_assign_client',['admin_data'=>$admin_data,'user_type'=>$user_type,'customer_data'=>$customer_details,'team_member'=>$data,'services_data'=>$services_data,'managers'=>$manager_data,'invoice'=>$invoices]);
  }


 public function leadsView($customer_id)
  {
    $id = session('admin');
    $admin_data = self::userDetails($id);
    $customer_id = Crypt::decrypt($customer_id);

    // Fetch customer details
    $clients = DB::table("customer")
        ->join("customer_service", "customer_service.customer_main_id", "=", "customer.customer_id")
        ->join("services", "services.service_id", "=", "customer_service.customer_service_id")
        ->where("customer.customer_id", $customer_id)
        ->select("customer.*", "customer_service.customer_main_id", "services.*")
        ->distinct("customer_service.customer_main_id")
        ->first();

    if (!$clients) {
        abort(404, "Customer not found");
    } 

    // Fetch remarks and customer data
    $remark = DB::table('customer')
        ->join('remark', 'remark.customer_id', '=', 'customer.customer_id')
        ->join('main_user', 'main_user.id', '=', 'remark.user_id')
        ->where('customer.customer_id', '=', $customer_id)
        ->get([
            'remark.*',
            'customer.customer_id',
            'customer.customer_service_id',
            'customer.customer_name',
            'main_user.user_type',
            'main_user.first_name',
            'main_user.last_name'
        ]);

        $subservices = DB::table("customer_subservice")
        ->join("customer","customer.customer_id",'=',"customer_subservice.customer_main_id")
        ->join("subservices","subservices.id","=","customer_subservice.customer_subservice_id")
        ->where("customer.customer_id",$customer_id)
        ->get();
        
           $packages = DB::table("customer_package")
        ->join("customer","customer.customer_id",'=',"customer_package.customer_main_id")
        ->join("packages","packages.package_id",'=','customer_package.customer_package_id')
        ->where("customer.customer_id",$customer_id)
        ->get();



    // Fetch services
    $services = Service::orderBy('service_id', "DESC")->get();

    // Fetch package details
    $package_details = DB::table('customer')
        ->select('packages.title', 'packages.price as package_price', 'invoices.price as invoice_price', 'packages.package_id', 'invoices.title as custom_title')
        ->join('invoices', 'invoices.customer_id', '=', 'customer.customer_id')
        ->leftJoin('packages', 'packages.package_id', '=', 'invoices.package_id')
        ->where('customer.customer_id', '=', $customer_id)
        ->get();

        $service_data = DB::table('services')
        ->join("customer_service","customer_service.customer_service_id",'=','services.service_id')
        ->where("customer_service.customer_main_id",$customer_id)
        ->get();

$mainServices = DB::table('services')->select('service_id', 'name')->get();
$services = DB::table('subservices')->select('id', 'service_name', 'service_id')->get();
$subServices = DB::table('sub_subservice')->select('sub_subservice_id', 'sub_subservice_name', 'sub_service_main_id')->get();
$packages = DB::table('packages')->select('package_id', 'title', 'price', 'duration', 'subservice_id', 'service_id', 'sub_subservice_id')->get();

$customerPackages = DB::table('packages')
->join("customer_package","customer_package.customer_package_id","=","packages.package_id")
->select('package_id', 'title', 'price', 'duration', 'subservice_id', 'service_id', 'sub_subservice_id')
->where("customer_package.customer_main_id",$customer_id)
->get();

$data = $mainServices->map(function ($mainService) use ($services, $subServices, $packages) {
    // Attach packages to Main Service
    $mainService->packages = $packages->where('service_id', $mainService->service_id)
                                      ->whereNull('subservice_id')
                                      ->whereNull('sub_subservice_id');

    // Attach services to Main Service
    $mainService->services = $services->where('service_id', $mainService->service_id)->map(function ($service) use ($subServices, $packages) {
        // Attach packages to Service
        $service->packages = $packages->where('subservice_id', $service->id)
                                      ->whereNull('sub_subservice_id');

        // Attach sub-services to Service
        $service->subServices = $subServices->where('sub_service_main_id', $service->id)->map(function ($subService) use ($packages) {
            // Attach packages to Sub-Service
            $subService->packages = $packages->where('sub_subservice_id', $subService->sub_subservice_id);
            return $subService;
        });

        return $service;
    });

    return $mainService;
});



     

    // Pass data to the view
    return view('admin.dashboard.leads_view', [
        'admin_data' => $admin_data,
        'customer' => $clients,
        'service_data' => $service_data,
        'remark' => $remark,
        'data' => $data,
        'customer_packages' => $customerPackages,
        'services' => $services,
        'packages' => $packages,
        'subservices' => $subservices
    ]);
}




  
  public function getPackage(Request $request){
  $id = $request->package_id;
  $package_details=Package::find($id);
  return response()->json($package_details);
}

// public function invoicePerCustomer($id){
//   $user_id=session('admin');
//   $admin_data = self::userDetails($user_id);

//   $invoice_data = DB::table('packages')
//   ->join("customer_package","customer_package.customer_package_id","=","packages.package_id")
//   ->join('invoices','invoices.customer_package_main_id','=','customer_package.customer_package_tem_id')
//   ->join("customer","customer.customer_id","=","customer_package.customer_main_id")
//   ->where('customer_package.customer_package_tem_id',$id)
//   ->paginate(10); 
//   return view('admin.dashboard.service_invoices',['admin_data'=>$admin_data,'data'=>$invoice_data]);
// }

public function allReports(){
    $id = session('admin');
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    $services = Service::orderBy('service_id','DESC')->paginate(10);
    return view('admin.dashboard.all_reports',['admin_data'=>$admin_data,'data'=>$services,'user_type'=>$user_type]);
}

public function payment(Request $request){
  $customer = $request->customer; 
  $invoice = $request->invoice;
if(!$customer  || !$invoice){
  return redirect('/');
}
$customer_id = Crypt::decrypt($customer); 
$invoice_id = Crypt::decrypt($invoice); 

    $invoice_detials =  Invoice::find($invoice_id);
    if($invoice_detials){
      if($invoice_detials->payment_status>0){
        return view('admin.payment_done');
      }

    $price = 0;
    if($invoice_detials->amount==null){
      $price = $invoice_detials->price;
    }else{
      $price = $invoice_detials->amount;
    }
    }else{
  return redirect('/');
    }

   
    return view('admin.pay',['price'=>$price,'invoice'=>$invoice_detials]);
}
// public function emailSend(Request $request){
//    $id = $request->customer_id;
//    $invoice_id =$request->invoice_id;
//     $user_id = session('admin');
//     $admin_data = self::userDetails($user_id);

 
  
//     $customer_data = CustomerModel::find($id);
    

//     $email =$customer_data->customer_email;
//     $msg=$customer_data->msg;
//     $user['to'] = $email;

//     $invoice_details = Invoice::find($invoice_id);
    
//     // dd($customer_data);

//     $data = ['invoice_details'=>$invoice_details,'admin_data'=>$admin_data,'clients'=>$customer_data];
//     $send =   Mail::send('admin.dashboard.invoice_mail',$data,function($messages)use($user)
//     {$messages->to($user['to']);
//       $messages->subject('Business Email');
//     });

//   if($send){
//     $save = new EmailModel;
//     $save->email_admin = session('admin');
//     $save->email_customer = $id;
//     $save->email_text = $msg;
//     $save->save();
//    return self::toastr(true,'Email Send Successfully','success','Success');
//   }else{
//    return self::toastr(false,'Please Try again Later','error','Error');
//   }
  
// }

public function emailSend(Request $request)
{
    try {
        // Retrieve input data
        $customerId = $request->customer_id;
        $invoiceId = $request->invoice_id;
        $adminId = session('admin');

        // Fetch required data
        $adminData = self::userDetails($adminId);
        $customerData = CustomerModel::findOrFail($customerId);
        $invoiceDetails = Invoice::findOrFail($invoiceId);

        // Prepare email data
        $email = $customerData->customer_email;
        $messageText = $customerData->msg;

        $emailData = [
            'invoice_details' => $invoiceDetails,
            'admin_data'      => $adminData,
            'clients'         => $customerData
        ];

        // Send email
        Mail::send('admin.dashboard.invoice_mail', $emailData, function ($message) use ($email) {
            $message->to($email)
                    ->subject('Business Email');
        });

        // Save email details in the database
        EmailModel::create([
            'email_admin'    => $adminId,
            'email_customer' => $customerId,
            'email_text'     => $messageText,
        ]);

        return self::toastr(true, 'Email Sent Successfully', 'success', 'Success');

    } catch (\Exception $e) {
        // Handle errors gracefully
        \Log::error('Email Sending Error: ' . $e->getMessage());
        return self::toastr(false, 'Email could not be sent. Please try again later.', 'error', 'Error');
    }
}
 public function showInvoiceList($id){
   $user_id=session('admin');
   $admin_data = self::userDetails($user_id);

   $invoice_data = DB::table('invoices')
   ->join("customer_package","customer_package.customer_package_tem_id","=","invoices.customer_package_main_id")
   ->join("customer","customer.customer_id","=","customer_package.customer_main_id")
   ->join("packages","packages.package_id","=","customer_package.customer_package_id")
   ->where("customer.customer_id",$id)
   ->paginate(10);   
     
  // echo "<pre>";
  // print_r($invoice_data);
  // die;
  return view('admin.dashboard.leads_invoice_list',['admin_data'=>$admin_data,'data'=>$invoice_data]);

  }

  public function showSuccessfullPayments(){
   $user_id=session('admin');
   $admin_data = self::userDetails($user_id);
   if($admin_data->user_type == 'admin'){
       $data = DB::table('payments')
       ->join('customer','customer.customer_id','=','payments.leads_id')
       ->where('payments.pay_status',1)
       ->orderBy('payments.payment_id','DESC')
       ->paginate(10);
     
   }else{
     $data = DB::table('payments')
       ->join('customer','customer.customer_id','=','payments.leads_id')
       ->where('payments.pay_status',1)
       ->orderBy('payments.payment_id','DESC')
       ->paginate(10);
   }

  //  else if($admin_data->user_type == "operation_manager" || $admin_data->user_type =="team_manager"){
  //      $operation_manager_services = TeamManagersServicesModel::where('team_manager_id',$admin_data->user_id)->distinct()->get(['managers_services_id']);
  //      $service_id = [];
      
  //      foreach($operation_manager_services as $service){
  //       $service_id[] = $service->managers_services_id;
  //     }
  //      $data = DB::table('payments')
  //      ->join('customer','customer.customer_id','=','payments.leads_id')
  //      ->whereIn('customer.customer_service_id',$service_id)
  //      ->where('payments.pay_status',1)
  //      ->orderBy('payments.payment_id','DESC')
  //      ->paginate(10);
     
      
  //  }else if($admin_data->user_type == "customer_success_manager"){
  //      $customer_success_manager_services = MemberServiceModel::where('member_id', $admin_data->user_id)
  //             ->distinct()
  //             ->get(['member_service_id']); 

  //       $service_id=[];
  //       if(!empty($customer_success_manager_services)){
  //               foreach($customer_success_manager_services as $service){
  //                   $service_id[] = $service->member_service_id;
  //               }  
  //               $data = DB::table('payments')
  //              ->join('customer','customer.customer_id','=','payments.leads_id')
  //              ->whereIn('customer.customer_service_id',$service_id)
  //              ->where('payments.pay_status',1)
  //              ->orderBy('payments.payment_id','DESC')
  //              ->paginate(10);
                 

  //       }

      
  //  }
  return view('admin.dashboard.successfull_payments',['admin_data'=>$admin_data,'data'=>$data]);
  }

  public function fileShow($filename){
    $user_id=session('admin');
    $admin_data = self::userDetails($user_id);
    return view('admin.dashboard.file_view',['admin_data'=>$admin_data,'filename'=>$filename]);

  }
  
  
    public function showFailedPayments(){
        $user_id=session('admin');
   $admin_data = self::userDetails($user_id);
   if($admin_data->user_type == "admin"){
     $data = DB::table('payments')
   ->join('customer','customer.customer_id','=','payments.leads_id')
   ->where('payments.pay_status',0)
   ->orderBy('payments.payment_id','DESC')
   ->paginate(10);
   }else{
       $data = DB::table('payments')
   ->join('customer','customer.customer_id','=','payments.leads_id')
   ->where('payments.pay_status',0)
   ->orderBy('payments.payment_id','DESC')
   ->paginate(10);
   }
 
  //  }
  //  else if($admin_data->user_type =="operation_manager" || $admin_data->user_type =="team_manager"){
  //      $operation_manager_services = TeamManagersServicesModel::where('team_manager_id',$admin_data->user_id)->distinct()->get(['managers_services_id']);
  //      $service_id = [];
      
  //      foreach($operation_manager_services as $service){
  //       $service_id[] = $service->managers_services_id;
  //     }
  //      $data = DB::table('payments')
  //      ->join('customer','customer.customer_id','=','payments.leads_id')
  //      ->whereIn('customer.customer_service_id',$service_id)
  //      ->where('payments.pay_status',0)
  //      ->orderBy('payments.payment_id','DESC')
  //      ->paginate(10);
     

  //  }else if($admin_data->user_type == "customer_success_manager"){
  //      $customer_success_manager_services = MemberServiceModel::where('member_id', $admin_data->user_id)
  //             ->distinct()
  //             ->get(['member_service_id']); 

  //       $service_id=[];
  //       if(!empty($customer_success_manager_services)){
  //               foreach($customer_success_manager_services as $service){
  //                   $service_id[] = $service->member_service_id;
  //               }  
  //               $data = DB::table('payments')
  //              ->join('customer','customer.customer_id','=','payments.leads_id')
  //              ->whereIn('customer.customer_service_id',$service_id)
  //              ->where('payments.pay_status',0)
  //              ->orderBy('payments.payment_id','DESC')
  //              ->paginate(10);
                 

  //       }
  //  }
    return view('admin.dashboard.unsuccessfull_payments',['admin_data'=>$admin_data,'data'=>$data]);
    
  }
  public function documentPage($customers_id){
      $user_id=session('admin');
      $admin_data = self::userDetails($user_id);
      $user_type = self::userType($admin_data->user_type);
      $customer_id = decrypt($customers_id);
      $data=DB::table('files')
        ->select('customer.customer_id','files.file','files.paid_customer_id','files.created_at')
        ->join('customer','customer.customer_id','=','files.customer_id')
        ->where('customer.customer_id','=',$customer_id)
        ->paginate(10);
      //  echo '<pre>';
      //  print_r($data);die;
          
      return view('admin.dashboard.document_list',['admin_data'=>$admin_data,'document_data'=>$data,'user_type'=>$user_type]);
  }


  //  THIS IS noneAssginClientspage FUNCTION 
public function importsLeadPage(Request $request){
    $service_filter = $request->service;
    $id = session('admin');
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    $services = Service::orderBy('service_id','DESC')->where('name','!=','uncategorized')->get();

    if($admin_data->user_type=="admin"){

         $customers = DB::table('customer')
    // ->join('services', 'services.service_id', '!=', 'customer.customer_service_id')
    ->where('customer_service_id', '=', 14)
    ->orderBy('customer_id', 'DESC')
    ->paginate(25);

    //   $customers = DB::table('customer')
    // ->join('services', 'services.service_id', '!=', 'customer.customer_service_id')
    // ->where('customer.customer_service_id', '=', 14)
    // ->orderBy('customer.customer_id', 'DESC')
    // ->paginate(25);

   }else if($admin_data->user_type=="operation_manager"){
        $customers =DB::table('customer')->join('services','services.service_id','=','customer.customer_service_id')->join('team_manager_services','team_manager_services.managers_services_id','=','customer.customer_service_id')->where('customer.team_member',null)->orderBy('customer_id','DESC')
        ->where('team_manager_services.team_manager_id','=',$admin_data->id)
        ->where('customer.customer_service_id','=',14)
        ->paginate(25);
   }else{
    return redirect('/login');
   }



  return view('admin.dashboard.import_lead_show',['user_type'=>$user_type,'admin_data'=>$admin_data,'data'=>$customers,'services'=>$services]);

}


public function assignLeadsToService(Request $request){
  $customers[] = $request->customer;
  $service[] = $request->service;
  
  // echo "<pre>";
  // print_r($customers);  
  // print_r($service);
  // die;
  
foreach ($customers[0] as $item => $customer_id) {
    foreach ($service[0] as $key => $service_id) {
        // Find the existing customer record by customer_id
        $update = CustomerModel::find($customer_id);


        // print_r($update);
        // die;
        
        if ($update) {
            // Create a new CustomerModel instance
            $customer = new CustomerModel();
            $customer->customer_service_id = $service_id;  // Here, you're assigning the service ID instead of the old one
            $customer->customer_name = $update->customer_name;
            $customer->customer_number = $update->customer_number;
            $customer->customer_email = $update->customer_email;
            $customer->task = $update->task;
            $customer->team_member = $update->team_member;
            $customer->status = $update->status;
            $customer->type = $update->type;
            $customer->first_name = $update->first_name;
            $customer->middle_name = $update->middle_name;
            $customer->last_name = $update->last_name;
            $customer->dob = $update->dob;
            $customer->address = $update->address;
            $customer->city = $update->city;
            $customer->state = $update->state;
            $customer->zip = $update->zip;
            $customer->ssn = $update->ssn;
            $customer->business_name = $update->business_name;
            $customer->industry = $update->industry;
            $customer->fax = $update->fax;
            $customer->contact_number = $update->contact_number;
            $customer->contact_email = $update->contact_email;
            $customer->ein = $update->ein;
            $customer->business_title = $update->business_title;
            $customer->point_of_contact = $update->point_of_contact;
            $customer->msg = $update->msg;
            $customer->paid_customer = $update->paid_customer;
            $customer->save();
          }
    }
          $update->delete();

}

  return self::swal(true,'Assign Successfull','success');
}
public function changeStatus(Request $request){
      $customer_id =$request->customer_id;
      $status=$request->status;
      $customer_details = CustomerModel::find($customer_id);
      if($status == '1'){
         $customer_status = 0;
      }else if($status == '0'){
         $customer_status = 1;
      }
      $data=CustomerModel::where('customer_email',$customer_details->customer_email)->update([
        'status' => $customer_status]);
    
      if($data){
         return self::toastr(true,"Success","success","Success");

      }else{
         return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      }
      
}


function calculateUserDailyLoggedTime($userId) {
    // Fetch all login and logout records for the user, ordered by date
    $loginHistory = \DB::table('login_history')
                ->where('user_id', $userId)
                ->whereIn('operation', ['login', 'logout'])
                ->orderBy('logged_in_at', 'asc')
                ->get();

    $dailyDurations = []; // To store the working time for each date

    $currentLogin = null; // Keep track of the login timestamp

    foreach ($loginHistory as $entry) {
        $entryDate = Carbon::parse($entry->logged_in_at)->toDateString(); // Extract the date (YYYY-MM-DD)

        if ($entry->operation === 'login') {
            // Save the login timestamp
            $currentLogin = Carbon::parse($entry->logged_in_at);
        } elseif ($entry->operation === 'logout' && $currentLogin) {
            // Calculate the duration if a logout follows a login
            $logoutTime = Carbon::parse($entry->logged_in_at);
            $duration = $logoutTime->diffInSeconds($currentLogin);

            // Store the duration for the corresponding date
            if (!isset($dailyDurations[$entryDate])) {
                $dailyDurations[$entryDate] = 0;
            }
            $dailyDurations[$entryDate] += $duration;

            // Reset the current login to null after logout
            $currentLogin = null;
        }
    }

    // Convert durations to a human-readable format (HH:MM:SS)
    $result = [];
    foreach ($dailyDurations as $date => $totalSeconds) {
        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;

        $result[$date] = [
            'total_seconds' => $totalSeconds,
            'formatted' => sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds)
        ];
    }

    return $result;
}




// THIS IS END OF THE CLASS 

function loginDetails($userId) {
  $user_id=session('admin');
  $admin_data = self::userDetails($user_id);
  $user_type = self::userType($admin_data->user_type);
    // Fetch all login and logout records for the user, ordered by date

  $loginHistory = \DB::table('login_history')
        ->where('user_id', $userId)
        ->whereIn('operation', ['login', 'logout'])
        ->orderBy('logged_in_at', 'asc')
        ->get();

    $dailyDurations = []; // To store total logged-in time per day
    $currentLogin = null; // To track the current login time

    foreach ($loginHistory as $entry) {
        $entryDate = Carbon::parse($entry->logged_in_at)->toDateString(); // Extract the date (YYYY-MM-DD)

        if ($entry->operation === 'login') {
            // Start tracking login time for this user
            $currentLogin = Carbon::parse($entry->logged_in_at);
        } elseif ($entry->operation === 'logout' && $currentLogin) {
            // Calculate duration if logout follows a login
            $logoutTime = Carbon::parse($entry->logged_in_at);

            // Ensure logout is after login
            if ($logoutTime->greaterThan($currentLogin)) {
                $duration = $logoutTime->diffInSeconds($currentLogin);

                // Add duration to the total for the day
                if (!isset($dailyDurations[$entryDate])) {
                    $dailyDurations[$entryDate] = 0;
                }
                $dailyDurations[$entryDate] += $duration;
            }

            // Reset current login after calculating duration
            $currentLogin = null;
        }
    }

    

    // Format and print results

  return view('admin.dashboard.login_details',['admin_data'=>$admin_data,'user_type'=>$user_type,'daily_login_times'=>$dailyDurations]);

}
  public function individualReport(){
       $user_id=session('admin');
       $admin_data = self::userDetails($user_id);
       $user_type = self::userType($admin_data->user_type);
      return view('admin.dashboard.individual_report',['admin_data'=>$admin_data,'user_type'=>$user_type]);
  }
  public function downloadPDF(Request $request){
        $reports = $request->reports;
        $date = $request->date;
        if($reports == 1){
          $leads_data = DB::table('customer')
          ->select(
              'customer.customer_email',
              DB::raw('MAX(customer.customer_id) as customer_id'),
              DB::raw('MAX(customer.customer_number) as customer_number'),
              DB::raw('MAX(customer.customer_name) as customer_name'),
              DB::raw('MAX(customer.status) as status'),
              DB::raw('MAX(customer.city) as city'),
              DB::raw('MAX(customer.state) as state'),
              DB::raw('MAX(customer.type) as type'),
              DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
          )
          ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
          ->where('customer.dob',$date)
          ->where('customer.type',1)
          ->groupBy('customer.customer_email') 
          ->get();
        }elseif($reports == 2){
          $leads_data = DB::table('customer')
          ->select(
              'customer.customer_email',
              DB::raw('MAX(customer.customer_id) as customer_id'),
              DB::raw('MAX(customer.customer_number) as customer_number'),
              DB::raw('MAX(customer.customer_name) as customer_name'),
              DB::raw('MAX(customer.status) as status'),
              DB::raw('MAX(customer.city) as city'),
              DB::raw('MAX(customer.state) as state'),
              DB::raw('MAX(customer.type) as type'),
              DB::raw('MAX(invoices.price) as price'),
              DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
          )
          ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
          ->join('invoices','invoices.customer_id','=','customer.customer_id')
          ->where('customer.paid_customer',1)
          ->where('customer.type',1)
          ->groupBy('customer.customer_email') 
          ->get();
        }elseif($reports == 3){
          $leads_data = DB::table('customer')
          ->select(
              'customer.customer_email',
              DB::raw('MAX(customer.customer_id) as customer_id'),
              DB::raw('MAX(customer.customer_number) as customer_number'),
              DB::raw('MAX(customer.customer_name) as customer_name'),
              DB::raw('MAX(customer.status) as status'),
              DB::raw('MAX(customer.city) as city'),
              DB::raw('MAX(customer.state) as state'),
              DB::raw('MAX(customer.type) as type'),
              DB::raw('MAX(invoices.price) as price'),
              DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
          )
          ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
          ->join('invoices','invoices.customer_id','=','customer.customer_id')
          ->where('customer.paid_customer',0)
          ->where('customer.type',1)
          ->groupBy('customer.customer_email') 
          ->get();
        }
       // echo '<pre>';
       // print_r($leads_data);die;
        $pdf = PDF::loadView('admin.dashboard.show_pdf',['leads_data'=>$leads_data,'reports'=>$reports]);
        return $pdf->stream('show_pdf.pdf');
  }
   
  public function businessReport(){
       $user_id=session('admin');
       $admin_data = self::userDetails($user_id);
       $user_type = self::userType($admin_data->user_type);
       return view('admin.dashboard.business_report',['admin_data'=>$admin_data,'user_type'=>$user_type]);
  } 
  
   public function businessReportPdf(Request $request){
        $reports = $request->reports;
       if($reports == 1){
          $leads_data = DB::table('customer')
          ->select(
              'customer.customer_email',
              DB::raw('MAX(customer.customer_id) as customer_id'),
              DB::raw('MAX(customer.customer_number) as customer_number'),
              DB::raw('MAX(customer.customer_name) as customer_name'),
              DB::raw('MAX(customer.status) as status'),
              DB::raw('MAX(customer.city) as city'),
              DB::raw('MAX(customer.state) as state'),
              DB::raw('MAX(customer.type) as type'),
              DB::raw('MAX(invoices.price) as price'),
              DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
          )
          ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
          ->join('invoices','invoices.customer_id','=','customer.customer_id')
          ->where('customer.paid_customer',1)
          ->where('customer.type',2)
          ->groupBy('customer.customer_email') 
          ->get();
        }elseif($reports == 2){
          $leads_data = DB::table('customer')
          ->select(
              'customer.customer_email',
              DB::raw('MAX(customer.customer_id) as customer_id'),
              DB::raw('MAX(customer.customer_number) as customer_number'),
              DB::raw('MAX(customer.customer_name) as customer_name'),
              DB::raw('MAX(customer.status) as status'),
              DB::raw('MAX(customer.city) as city'),
              DB::raw('MAX(customer.state) as state'),
              DB::raw('MAX(customer.type) as type'),
              DB::raw('MAX(invoices.price) as price'),
              DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
          )
          ->join('services', 'services.service_id', '=', 'customer.customer_service_id')
          ->join('invoices','invoices.customer_id','=','customer.customer_id')
          ->where('customer.paid_customer',0)
          ->where('customer.type',2)
          ->groupBy('customer.customer_email') 
          ->get();
        }
       // echo '<pre>';
       // print_r($leads_data);die;
        $pdf = PDF::loadView('admin.dashboard.business_pdf',['leads_data'=>$leads_data,'reports'=>$reports]);
        return $pdf->stream('business_pdf.pdf');
  }
  public function staffReport(){
       $user_id=session('admin');
       $admin_data = self::userDetails($user_id);
       $user_type = self::userType($admin_data->user_type);
       $services = Service::orderBy('service_id','DESC')->get();
       $staff_type =Role::orderBy('id','DESC')->get();
       return view('admin.dashboard.staff_report',['admin_data'=>$admin_data,'user_type'=>$user_type,'services_data'=>$services,'staff_type'=>$staff_type]);
  } 
  
  public function staffReportPdf(Request $request){
        $service = $request->service;
        $staff_type = $request->staff_type;
        $role_details =Role::where('id',$staff_type)->first();
        /*if($staff_type == 'customer_success_manager'){
           $data = DB::table('main_user')
          ->select('main_user.id','main_user.first_name','main_user.last_name','main_user.phone_number','main_user.email_address','services.name as service_name','main_user.user_type')
          ->join('member_service','member_service.member_id','=','main_user.id')
          ->join('services','services.service_id','=','member_service.member_service_id')
          ->where('main_user.user_type',$staff_type)
          ->where('member_service.member_service_id',$service)
          ->get();
        }else if($staff_type == 'team_manager' || $staff_type == 'operation_manager'){
           $data = DB::table('main_user')
          ->select('main_user.id','main_user.first_name','main_user.last_name','main_user.phone_number','main_user.email_address','services.name as service_name','main_user.user_type')
          ->join('team_manager_services','team_manager_services.team_manager_id','=','main_user.id')
          ->join('services','services.service_id','=','team_manager_services.managers_services_id')
          ->where('main_user.user_type',$staff_type)
          ->where('team_manager_services.managers_services_id',$service)
          ->get();
        }*/
         $data = DB::table('main_user')
          ->select('main_user.id','main_user.first_name','main_user.last_name','main_user.phone_number','main_user.email_address','services.name as service_name','main_user.user_type')
          ->join('role_services','role_services.member_id','=','main_user.id')
          ->join('services','services.service_id','=','role_services.service_id')
          ->where('main_user.user_type',$staff_type)
          ->where('role_services.service_id',$service)
          ->get();
        $pdf = PDF::loadView('admin.dashboard.staff_report_pdf',['data'=>$data,'role_details'=>$role_details]);
        return $pdf->stream('staff_report_pdf.pdf');
  }
  public function teamManagers(Request $request){
        $id = session('admin');
          $admin_data = self::userDetails($id);
          $user_type = $admin_data->user_type;

          if($user_type=="admin"){
              $contact_data = DB::table('main_user')->join('permission','permission.user_id','=','main_user.id')->join('roles','roles.role_name','=','main_user.user_type')->orderBy('main_user.id','DESC')->where('main_user.user_type',"=",'team_manager')->select('main_user.*','roles.modern_name')->paginate(10);
          }else if($user_type=="operation_manager"){

            $team_manager_services=TeamManagersServicesModel::where('team_manager_id',$admin_data->user_id)->get();
            
            $team_member=[];
            if(!empty($team_manager_services)){
                    $service_id = [];
                    foreach($team_manager_services as $service){
                      $service_id[] = $service->managers_services_id;
                    }
                    
                    $contact_data = DB::table("team_manager_services")   
                    ->select('team_manager_services.team_manager_id', DB::raw('MAX(main_user.first_name) as first_name'),DB::raw('MAX(main_user.id) as id'),DB::raw('MAX(main_user.user_type) as user_type'),DB::raw('MAX(main_user.last_name) as last_name'),DB::raw('MAX(main_user.phone_number) as phone_number'),DB::raw('MAX(main_user.email_address) as email_address'),DB::raw('MAX(services.name) as name'),DB::raw('MAX(roles.modern_name) as modern_name')) 
                    ->join("main_user", 'main_user.id', '=', 'team_manager_services.team_manager_id')
                    ->join('roles','roles.role_name','=','main_user.user_type')
                    ->join('services','services.service_id','=','team_manager_services.managers_services_id')
                    ->where('main_user.user_type',"team_manager")
                    ->whereIn('team_manager_services.managers_services_id', $service_id)
                    ->groupBy('team_manager_services.team_manager_id')
                    ->paginate(10);
             }

          } 
          $user_type = self::userType($admin_data->user_type);
        return view('admin.dashboard.all_team_managers',['admin_data'=>$admin_data,'data'=>$contact_data,'user_type'=>$user_type]);

    }

    



}