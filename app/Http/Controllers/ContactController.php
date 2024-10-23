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
use DB;
use Crypt;
use Mail;


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
          $user_details = DB::table('main_user')
            ->join('permission','permission.user_id','main_user.id')
            ->where('main_user.id',$id)
            ->first();
          
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
      $user_type = $request->user_type;

      $services_status = 0;
      
      if($user_type=="team_manager"){
        $services = $request->services;
        $services_status = 1;
      }
         if($user_type=="customer_success_manager"){
        $service = $request->service;
        $services_status = 2;
      }
      

      $service_manage = $request->service_manage;
      $package = $request->package;
      $leads_manage = $request->leads_manage;
      $invoice_manage = $request->invoice_manage;
      $payment_manage = $request->payment_manage;
      $customer_manage = $request->customer_manage;
      $email_sms_manage = $request->email_sms_manage;

      $communication = $request->communication;
      $report = $request->report;
      $document_view = $request->document_view;
      $client_financial = $request->client_financial;

      $client_contact_info = $request->client_contact_info;
      $delete_client = $request->delete_client;
      $delete_all_record = $request->delete_all_record;

      $document_download = $request->document_download;
      $lead_assign = $request->lead_assign;
      $email_template = $request->email_template;
      
      $history_manage = $request->history_manage;
      $account_name = $request->account_name;
      $password = $request->password;
      $password_hint = $request->password_hint;
      $after_login_setting_change = $request->after_login_setting_change;
      $disable_account = $request->disable_account;
      $team_manager_permission = $request->manager_manage;
      $customer_success_manager_permission = $request->member_manage;
      $user_registration_permission = $request->user_registration;
      

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
      $contact_details->password_hint = $password_hint;
      $contact_details->first_name = $first_name;
      $contact_details->last_name	 = $last_name ;
      $contact_details->phone_number = $phone ;
      $contact_details->email_address = $email ;
      $contact_details->user_type = $user_type ;
      $contact_details->change_password_upon_login = $after_login_setting_change ;
      $contact_details->disable_account = $disable_account ;
      $contact_details->save();
      
      $user_id = $contact_details->id;
      $permissions = new PermissionModel;
      $permissions->user_id = $user_id ;
      $permissions->user_type = $user_type ;
      $permissions->service_permission = $service_manage ;
      
      $permissions->team_manager_permission = $team_manager_permission ;
      $permissions->customer_success_manager_permission = $customer_success_manager_permission ;
      
      $permissions->leads_permission = $leads_manage ;
      $permissions->invoice_permission = $invoice_manage ;
      $permissions->payment_permission = $payment_manage ;
      $permissions->customer_permission = $customer_manage ;
      $permissions->email_sms_permission = $email_sms_manage ;
      $permissions->communication_permission = $communication ;
      $permissions->report_permission = $report ;
      $permissions->document_view_permission = $document_view ;
      $permissions->client_financial_data_permission = $client_financial ;
      $permissions->client_contact_permission = $client_contact_info ;
      $permissions->delete_all_record_permission = $delete_all_record ;
      $permissions->document_download_permission = $document_download ;
      $permissions->lead_assign_permission = $lead_assign ;
      $permissions->email_template_permission = $email_template ;
      $permissions->login_history_permission = $history_manage ;
      $permissions->package_permission = $package;
      $permissions->user_registration_permission = $user_registration_permission ;
     
      $permissions->save();

    if($services_status==1){
      $data = new TeamManagersServicesModel;
      $data->team_manager_id = $user_id;
      $data->managers_services_id = json_encode($services);
      $data->save();
    }
      if($services_status==2){
      $data = new MemberServiceModel;
      $data->member_id = $user_id;
      $data->member_service_id = $service;
      $data->save();
    }




      return self::toastr(true,"Registration Successfull","success","Success");
      
    }
    // THIS IS contactAdd FUNCTION 



// THIS IS editUserPage FUNCTION   
  public function editUserPage($contact_id){
     $id = session('admin');
     $admin_data = self::userDetails($id);
     $user_type = self::userType($admin_data->user_type);
     $data = MainUserModel::find($contact_id);
     $services = Service::orderBy('service_id','DESC')->get();
     $permissions_data = PermissionModel::where('user_id',$contact_id)->first();
     $team_services_id=''; $s_data='';$customer_service='';
     if($data['user_type'] == 'team_manager'){
            $services_data  = DB::table('team_manager_services')
            ->join('main_user','main_user.id','=','team_manager_services.team_manager_id')
            ->where('main_user.id',$contact_id)->first();
            $services_id = $services_data->managers_services_id;
           $s_id =  json_decode($services_id);
           $s_data = Service::whereIn('service_id',$s_id)->get();
           $team_services_id = $services_data->id;
     }elseif($data['user_type'] == 'customer_success_manager'){
          $customer_service =MemberServiceModel::where('member_id',$data['id'])->first();

     }
 return view('admin.dashboard.edit_contact',['admin_data'=>$admin_data,'data'=>$data,'services'=>$services,'user_type'=>$user_type,'permissions_data'=>$permissions_data,'s_data'=>$s_data,'$team_manager_services'=>$team_services_id,'customer_service'=>$customer_service]);
   
  }
 
// THIS IS editUserPage FUNCTION   

// THIS IS updateContact FUNCTION 
public function updateContact(Request $request){
  
      $phone = $request->phone;
      $first_name = $request->first_name;
      $last_name = $request->last_name;
      $email = $request->email;
      $user_type = $request->user_type;
      $user_id = $request->user_id;
      $permissions_id = $request->permissions_id;

      $service_manage = $request->service_manage;
      $leads_manage = $request->leads_manage;
      $invoice_manage = $request->invoice_permission;
      $payment_manage = $request->payment_permission;
      $customer_manage = $request->customer_manage;
      $email_sms_manage = $request->email_sms_manage;

      $communication = $request->communication;
      $report = $request->report;
      $document_view = $request->document_view;
      $client_financial = $request->client_financial;

      $client_contact_info = $request->client_contact_info;
      $delete_client = $request->delete_client;
      $delete_all_record = $request->delete_all_record;

      $document_download = $request->document_download;
      $lead_assign = $request->lead_assign;
      $email_template = $request->email_template;
      
      $history_manage = $request->history_manage;
      $account_name = $request->account_name;
      $password = $request->password;
      $password_hint = $request->password_hint;
      $change_password_upon_login = $request->change_password_upon_login;
      $disable_account = $request->disable_account;
      $team_manager_permission = $request->manager_manage;
      $customer_success_manager_permission = $request->member_manage;
      $user_registration_permission = $request->user_registration;
      $package = $request->package;
      
      $contact_details = MainUserModel::find($user_id);
      $contact_details->account_name = $account_name;
      $contact_details->password=$password;
      $contact_details->password_hint = $password_hint;
      $contact_details->first_name = $first_name;
      $contact_details->last_name  = $last_name ;
      $contact_details->phone_number = $phone ;
      $contact_details->email_address = $email ;
      $contact_details->change_password_upon_login = $change_password_upon_login ;
      $contact_details->disable_account = $disable_account ;
      $contact_details->save();
      
      $permissions = PermissionModel::find($permissions_id);
      $permissions->service_permission = $service_manage ;
      $permissions->team_manager_permission = $team_manager_permission ;
      $permissions->customer_success_manager_permission = $customer_success_manager_permission ;
      $permissions->leads_permission = $leads_manage ;
      $permissions->invoice_permission = $invoice_manage ;
      $permissions->payment_permission = $payment_manage ;
      $permissions->customer_permission = $customer_manage ;
      $permissions->email_sms_permission = $email_sms_manage ;
      $permissions->communication_permission = $communication ;
      $permissions->report_permission = $report ;
      $permissions->document_view_permission = $document_view ;
      $permissions->client_financial_data_permission = $client_financial ;
      $permissions->client_contact_permission = $client_contact_info ;
      // $permissions->customer_success_manager_permission = $customer_success_manager_permission;
      $permissions->delete_client_record_permission =$delete_client;
      $permissions->delete_all_record_permission = $delete_all_record ;
      $permissions->document_download_permission = $document_download ;
      $permissions->lead_assign_permission = $lead_assign ;
      $permissions->email_template_permission = $email_template ;
      $permissions->login_history_permission = $history_manage ;
      $permissions->user_registration_permission = $user_registration_permission ;
      $permissions->package_permission = $package;
      $permissions->save();
      $services_status = 0;
      
      if($user_type=="team_manager"){
        $services = $request->services;
      
        $team_manager_id =$request->team_manager_id;
        $data = TeamManagersServicesModel::find($team_manager_id);
        if(!empty($services)){
          $data->managers_services_id = json_encode($services);
          $data->save();
        }
      }elseif($user_type=="customer_success_manager"){
        $customer_service_id=$request->customer_service;
        $m_service=$request->m_service;
        $services_data=MemberServiceModel::find($customer_service_id);
        $services_data->member_service_id =$m_service;
        $services_data->save();
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

  $service = $request->service;
    if($service !=""){
      $customers =DB::table('customer')->join('services','services.service_id','=','customer.customer_service_id')->where('customer.team_member','!=',null)
      ->where('customer.customer_service_id',$service)->orderBy('customer_id','DESC')->get();
    }else{
         $customers =DB::table('customer')->join('services','services.service_id','=','customer.customer_service_id')->where('customer.team_member','!=',null)->orderBy('customer_id','DESC')->get();
    }

    // echo "<pre>";
    // print_r($customers);
    // die();

  $id = session('admin');
   $admin_data = self::userDetails($id);
   $user_type = self::userType($admin_data->user_type);
   
   $team = MainUserModel::where('user_type','customer_success_manager')->get();
   $services = Service::orderBy('service_id','DESC')->get();




  return view('admin.dashboard.assign_client',['user_type'=>$user_type,'admin_data'=>$admin_data,'data'=>$customers,'team'=>$team,'services'=>$services]);



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

public function getServiceBasedMembers(Request $request){
  $id = $request->id;
  $members = DB::table('main_user')->
  join('member_service','member_service.member_id','=','main_user.id')
  ->where('member_service.member_service_id',$id)->select('main_user.id','main_user.first_name','main_user.last_name')->get();
  return response()->json($members);
}

// checkBeforeAssign

// public function checkBeforeAssign(Request $request){
//   $id = $request->leads;
  
//   $service_id = []; 
//   for($i=0; $i<count($id); $i++){
//    $customer = CustomerModel::find($id[$i]);
//    $service_id = $customer->customer_service_id;

//   }
 
  
// }


//  THIS IS noneAssginClientspage FUNCTION 
public function noneAssginClientspage(Request $request){
    $service = $request->service;
    if($service !=""){
      $customers =DB::table('customer')->join('services','services.service_id','=','customer.customer_service_id')->where('customer.team_member',null)
      ->where('customer.customer_service_id',$service)->orderBy('customer_id','DESC')->get();
    }else{
         $customers =DB::table('customer')->join('services','services.service_id','=','customer.customer_service_id')->where('customer.team_member',null)->orderBy('customer_id','DESC')->get();
    }

  $id = session('admin');
   $admin_data = self::userDetails($id);
   $user_type = self::userType($admin_data->user_type);
   
   $team = MainUserModel::where('user_type','customer_success_manager')->get();
   $services = Service::orderBy('service_id','DESC')->get();




  return view('admin.dashboard.none_assign_client',['user_type'=>$user_type,'admin_data'=>$admin_data,'data'=>$customers,'team'=>$team,'services'=>$services]);

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
   //$admin_data = AdminModel::find($id);
   $admin_data = self::userDetails($id);
   $user_type = self::userType($admin_data->user_type);

   $emails = DB::table('user')
   ->join('email_send','email_send.email_admin','=','user.user_id')
   ->join('customer','customer.customer_id','=','email_send.email_customer')
   ->orderBy('email_send.email_id','DESC')
   ->paginate(10);
  return view('admin.dashboard.all_email',['admin_data'=>$admin_data,'data'=>$emails,'user_type'=>$user_type]);
}
// THIS IS emailPage FUNCTION 

// THIS IS emailShow FUNCTION 

public function emailShow($email_id){
  $email_id = decrypt($email_id);
   $email_details = DB::table('user')
   ->join('email_send','email_send.email_admin','=','user.user_id')
   ->join('customer','customer.customer_id','=','email_send.email_customer')
   ->where('email_send.email_id',$email_id)
   ->get();

  //  echo "<pre>";
  //  print_r($email_details);
  //  die();


   $id = session('admin');
   $admin_data = AdminModel::find($id);
  return view('admin.dashboard.email_show',['admin_data'=>$admin_data,'data'=>$email_details[0]]);
  
}
// THIS IS emailShow FUNCTION 


// THIS IS EXPORT FUNCTION 

public function export()
    {
        return Excel::download(new CustomerExport(), 'clients.xlsx');
    }

    // filterUsers
    public function filterUsers(Request $request){
      $filter = $request->filter;
      if($filter != ""){
        switch($filter){
          case "Operation Managers":
              $contact_data = DB::table('main_user')->join('permission','permission.user_id','=','main_user.id')->where('main_user.user_type',"operation_manager")->orderBy('id','DESC')->get();
            $id = session('admin');
          $admin_data = self::userDetails($id);
          $user_type = self::userType($admin_data->user_type);
         return view('admin.dashboard.contacts',['admin_data'=>$admin_data,'data'=>$contact_data,'user_type'=>$user_type]);
            break;
            case "Team Managers":
              
                $contact_data = DB::table('main_user')->join('permission','permission.user_id','=','main_user.id')->where('main_user.user_type',"team_manager")->orderBy('id','DESC')->get();
            $id = session('admin');
          $admin_data = self::userDetails($id);
          $user_type = self::userType($admin_data->user_type);
         return view('admin.dashboard.contacts',['admin_data'=>$admin_data,'data'=>$contact_data,'user_type'=>$user_type]);
            
            break;
                 case "Customer Success Manager":
                    $contact_data = DB::table('main_user')->join('permission','permission.user_id','=','main_user.id')->where('main_user.user_type',"customer_success_manager")->orderBy('id','DESC')->get();
            $id = session('admin');
          $admin_data = self::userDetails($id);
          $user_type = self::userType($admin_data->user_type);
         return view('admin.dashboard.contacts',['admin_data'=>$admin_data,'data'=>$contact_data,'user_type'=>$user_type]);
            
            break;
            default:
            break;
        }
      }else{
              $contact_data = DB::table('main_user')->join('permission','permission.user_id','=','main_user.id')->orderBy('id','DESC')->get();
            $id = session('admin');
          $admin_data = self::userDetails($id);
          $user_type = self::userType($admin_data->user_type);
         return view('admin.dashboard.contacts',['admin_data'=>$admin_data,'data'=>$contact_data,'user_type'=>$user_type]);
      }

    }


// THIS IS EXPORT FUNCTION 

// THIS IS IMPORT FUNCTION 
  public function import(Request $request) 
    {
         $file_ex = $request->csv->getClientOriginalExtension();
    if($file_ex=="csv"|| $file_ex=="xls"|| $file_ex=="xlsx"){
        Excel::import(new CustomerImport,
        request()->file('csv'));
        // if($file==true){
         return self::toastr('success','All Clients Upload Successfull','success','Success');    
        // }else{
      // return self::toastr('error','Sorry Not Upload Clients','error','Error');    
        // }

    }else{
          return self::toastr('error','Please Upload csv , xls or xlsx Files','error','Error');    
    } 
    
    }
// THIS IS IMPORT FUNCTION 

// THIS IS importPage FUNCTION  
public function importPage(){
   $id = session('admin');
   $admin_data = AdminModel::find($id);
     return view('admin.dashboard.import_customer',['admin_data'=>$admin_data]);
}
// THIS IS importPage FUNCTION  


// THIS IS smsPage FUNCTION 
public function smsPage(){
   $id = session('admin');
   //$admin_data = AdminModel::find($id);
   $admin_data = self::userDetails($id);
   $user_type = self::userType($admin_data->user_type);

   $sms = DB::table('user')
   ->join('messages','messages.team_member_id','=','user.user_id')
   ->join('customer','customer.customer_id','=','messages.customer_msg_id')
   ->orderBy('messages.messages_id','DESC')
   ->paginate(10);
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
      $admin_data = AdminModel::find($id);
      $members_data = DB::table('team_member')
      ->join('services', 'services.service_id', '=', 'team_member.team_service')
      ->select('team_member.*', 'services.name as service_name')
      ->orderBy('team_member.team_member_id', 'DESC')
      ->get();
      return view('admin.dashboard.team_member_lists',['admin_data'=>$admin_data,'data'=>$members_data]);
    }
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
  if(isset($main_user_data) && $main_user_data->user_type == 'team_manager'){
       $team_manager_services=TeamManagersServicesModel::where('team_manager_id',$id)->first();
       $service_id=json_decode($team_manager_services->managers_services_id);
       $invoice_data = DB::table('invoices')
       ->select('invoices.price as invoices_price','customer.customer_name','customer.customer_number','invoices.created_at','invoices.invoice_id','customer.customer_id','invoices.role')
       ->join('customer','customer.customer_id','=','invoices.customer_id')
       ->whereIn('invoices.service_id',$service_id)
       ->get();   
  }else if(isset($main_user_data) && $main_user_data->user_type == 'customer_success_manager'){
       $customer_success_manager_services=MemberServiceModel::where('member_id',$id)->first();
       $invoice_data = DB::table('invoices')
       ->select('invoices.price as invoices_price','customer.customer_name','customer.customer_number','invoices.created_at','invoices.invoice_id','customer.customer_id','invoices.role')
       ->join('customer','customer.customer_id','=','invoices.customer_id')
       ->where('invoices.service_id','=',$customer_success_manager_services->member_service_id)
       ->get();   
 
  }else{
       $invoice_data = DB::table('invoices')
       ->select('invoices.price as invoices_price','customer.customer_name','customer.customer_number','invoices.created_at','invoices.invoice_id','customer.customer_id','invoices.role')
       ->join('customer','customer.customer_id','=','invoices.customer_id')
       ->get();   
 
  }
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
    if(isset($data->user_type) && $data->user_type == 'team_manager'){
        $team_manager_services=TeamManagersServicesModel::where('team_manager_id',$data->id)->first();
        if(!empty($team_manager_services)){
            $service_id=json_decode($team_manager_services->managers_services_id);
            $total_team_member=DB::table('member_service')
              ->whereIn('member_service.member_service_id',$service_id)
              ->count();
            $total_invoices_data=Invoice::whereIn('service_id',$service_id)->count();
            $total_clients=CustomerModel::whereIn('customer_service_id',$service_id)->count();
        }         
    }else if(isset($data->user_type) && $data->user_type == 'customer_success_manager'){
          $customer_success_manager_services=MemberServiceModel::where('member_id',$data->id)->first();
        if(!empty($customer_success_manager_services)){
            $total_invoices_data=Invoice::where('service_id',$customer_success_manager_services->member_service_id)->count();
            $total_clients=CustomerModel::where('customer_service_id',$customer_success_manager_services->member_service_id)->count();

        }
    }else if(isset($data->user_type) && $data->user_type == 'admin'){
      $total_clients=CustomerModel::all()->count();
      $total_invoices_data=Invoice::all()->count();
      $total_team_member=CustomerModel::where('team_member','!=','null')->count();
    }
    return view('admin.dashboard.view_team_member',['admin_data'=>$admin_data,'user_type'=>$user_type,'data'=>$data,'total_team_member'=>$total_team_member,'clients'=>$total_clients, 'convert_to_clients'=>20,'invoice_data'=>$total_invoices_data]);
}
//viewTeamMember FUNCTION END
public function teamMemberList($manager_id){
    $id = session('admin');
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    $team_manager_services=TeamManagersServicesModel::where('team_manager_id',$manager_id)->first();
    $team_member=[];
    if(!empty($team_manager_services)){
            $service_id=json_decode($team_manager_services->managers_services_id);
            $team_member=DB::table('main_user')
            ->join('member_service','member_service.member_id','=','main_user.id')
            ->join('services','services.service_id','=','member_service.id')
            ->whereIn('member_service.member_service_id',$service_id)
            ->get();
     }else{
           $team_member=DB::table('main_user')
            ->join('member_service','member_service.member_id','=','main_user.id')
            ->join('services','services.service_id','=','member_service.id')
            ->where('main_user','main_user.user_type','=','customer_success_manager')
            ->get();
   
     }
   
    return view('admin.dashboard.members_list',['admin_data'=>$admin_data,'team_member'=>$team_member,'user_type'=>$user_type]);
}
public function showClientsList($manager_id){
    $id = session('admin');
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    $main_user_data =MainUserModel::find($manager_id);
    if(isset($main_user_data) && $main_user_data->user_type=='customer_success_manager'){
      $customer_service=MemberServiceModel::where('member_id',$manager_id)->first();
      $clients=DB::table('customer')
      ->select('customer.*','services.name as service_name')
      ->join('services','services.service_id','=','customer.customer_service_id')
      ->where('customer.customer_service_id','=',$customer_service->member_service_id)
      ->get();
    }else if(isset($main_user_data) && $main_user_data->user_type=='team_manager'){
       $team_manager_services=TeamManagersServicesModel::where('team_manager_id',$manager_id)->first();
        if(!empty($team_manager_services)){
            $service_id=json_decode($team_manager_services->managers_services_id);
            $clients=DB::table('customer')
            ->select('customer.*','services.name as service_name')
            ->join('services','services.service_id','=','customer.customer_service_id')
            ->whereIn('customer.customer_service_id',$service_id)
            ->get();
   


        }
    }else{
         $clients=DB::table('customer')
            ->select('customer.*','services.name as service_name')
            ->join('services','services.service_id','=','customer.customer_service_id')
            ->get();
    
    }
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
      $all_services = Service::all();
    return view('admin.dashboard.add_lead',['admin_data'=>$admin_data,'user_type'=>$user_type,'all_services'=>$all_services]);
}
 public function leadAdd(Request $request){
     $phone= $request->phone;
     $country_code = $request->country_code;
     $customer_number = $country_code.$phone;
     $team_member = $request->team_member;
      $name = $request->name;
      $email = $request->email;
      $msg = $request->msg;
      $service_id =$request->customer_service_id;
     

      $contact_details = new CustomerModel;
      $contact_details->customer_name = $name;
      $contact_details->customer_number = $customer_number ;
      $contact_details->customer_email = $email ;
      $contact_details->msg = $msg ;
      $contact_details->task = 1 ;
      $contact_details->customer_service_id = $service_id;
      $save = $contact_details->save();
      if($save){
         return self::toastr(true,"Lead Add Successfull","success","Success");
      }else{
         return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      }
      
    }
  public function viewLeads(){
      $id = session('admin');
      $admin_data = self::userDetails($id);
      $user_type = self::userType($admin_data->user_type);
      if($admin_data->user_type == 'admin' || $admin_data->user_type == 'operation_manager'){
        $leads_data = DB::table('customer')
        ->select('customer.customer_id', 'customer.customer_name', 'customer.customer_number', 'customer.customer_email','customer.msg','services.name','customer.status')
        ->join('services','services.service_id','=','customer.customer_service_id')
        // ->leftjoin('main_user','main_user.id','=','customer.team_member')
        // ->where('customer.status',1)
        ->get(); 
      }else if($admin_data->user_type == 'team_manager'){
        $leads_data = DB::table('team_manager_services')
        ->join('main_user','main_user.id','=','team_manager_services.team_manager_id')
        ->where('main_user.id',session('admin'))->first();

        if($leads_data){
          $services_id = $leads_data->managers_services_id;
          $services =  json_decode($services_id);
          $leads_data = DB::table('customer')
         ->select('customer.customer_id', 'customer.customer_name', 'customer.customer_number', 'customer.customer_email','customer.customer_service_id','customer.msg','services.name','customer.status','main_user.first_name','main_user.last_name')
         ->leftjoin('main_user','main_user.id','=','customer.team_member')
         ->join('services','services.service_id','=','customer.customer_service_id')
         ->whereIn('customer.customer_service_id',$services)
         ->where('customer.status',1)
          ->get();  
        }else{
          return redirect('/login/dashboard');
        }

      }else{
        $leads_data = DB::table('customer')
        ->select('customer.customer_id', 'customer.customer_name', 'customer.customer_number', 'customer.customer_email','customer.msg','customer.status','services.name','main_user.first_name','main_user.last_name')
        ->join('services','services.service_id','=','customer.customer_service_id')
        ->leftjoin('main_user','main_user.id','=','customer.team_member')
        ->where('customer.team_member',$admin_data->id)
        ->where('customer.status',1)
        ->get();  

      }
      return view('admin.dashboard.view_leads',['admin_data'=>$admin_data,'data'=>$leads_data,'user_type'=>$user_type]);
 }
 //chatShow FUNCTION START
  public function chatShow($customer_id){
     $id = session('admin');
     $admin_data = self::userDetails($id);
     $user_type = self::userType($admin_data->user_type);
     $customer_id =   Crypt::decrypt($customer_id);
     $customers = DB::table('customer')
     ->join('remark','remark.customer_id','=','customer.customer_id')
     ->where('customer.customer_id','=',$customer_id)
     ->get();
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
        $accountSid = "AC12e09a4b307d4b4dedd6a48a8b150809";
        $authToken = "190b69babc7531bf9960a498eba8d3f4";
        $twilioNumber = "+12567435707";
        
  // THIS IS API GET VARIABLE        
        $message = $request->input('message');
        $customer_id = $request->customer_id;

        $customer_details  = CustomerModel::find($customer_id);
        $number = $customer_details->customer_number;

        $twilio = new Client($accountSid, $authToken);

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
  $user_type = self::userType($admin_data->user_type);
  $data = CustomerModel::find($customer_id);
 return view('admin.dashboard.create_invoice',['admin_data'=>$admin_data,'data'=>$data,'user_type'=>$user_type]);
}
//createInvoice Function End
//invoiceAdd Function Start
public function invoiceAdd(Request $request){
      $date = $request->date;
      $price = $request->price;
      $description=$request->description;
      $customer_id=$request->customer_id;
      $user_id=$request->user_id;
      $role=$request->role;
      $service_id=$request->service_id;

      $invoice_details = new Invoice;
      $invoice_details->price = $price;
      $invoice_details->date = $date;
      $invoice_details->customer_id = $customer_id;
      $invoice_details->description = $description;
      $invoice_details->user_id = $user_id;
      $invoice_details->role = $role;
      $invoice_details->service_id=$service_id;
      $save = $invoice_details->save();
      $invoice_id =$invoice_details->invoice_id;

      if($save){
         return self::toastr(true,$invoice_id,"success","Success");

      }else{
         return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      }
      
}
//invoiceAdd Function End
//invoice2 Function Start
public function invoice2($customer_id,$invoice_id){
  $id = session('admin');
  $admin_data = self::userDetails($id);
  $user_type = self::userType($admin_data->user_type);
  $clients = CustomerModel::find($customer_id);
  $invoice_details = Invoice::find($invoice_id);
  return view('admin.dashboard.invoice',['admin_data'=>$admin_data,'clients'=>$clients,'invoice_details'=>$invoice_details,'user_type'=>$user_type]);

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
      $client_data = DB::table('customer')
      ->select('customer.customer_id','customer.customer_name','customer.customer_number','customer.customer_email','customer.msg','paid_customer.paid_customer_id','customer.status','services.name as services_name','main_user.first_name','main_user.last_name')
      ->join('paid_customer','paid_customer.customer_id','=','customer.customer_id')
      ->leftjoin('main_user','main_user.id','=','customer.team_member')
      ->join('services','services.service_id','=','customer.customer_service_id')
      ->where('customer.status',0)
      ->get();
      return view('admin.dashboard.view_clients',['admin_data'=>$admin_data,'data'=>$client_data,'user_type'=>$user_type]);
 }
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
      ->get();
     }else{
        $invoice_data = DB::table('main_user')
        ->select('main_user.first_name as user_first_name','main_user.last_name as user_last_name','invoices.price as invoices_price','customer.customer_name','customer.customer_number','invoices.created_at','invoices.invoice_id','customer.customer_id')
        ->join('invoices','invoices.user_id','=','main_user.id')
        ->join('customer','customer.customer_id','=','invoices.customer_id')
        ->where('main_user.id',$admin_data->id)
        ->get();

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
    return view('admin.dashboard.show_invoice',['admin_data'=>$admin_data,'clients'=>$clients,'invoice_details'=>$invoice_details,'user_type'=>$user_type]);
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
      $desc  = $request->desc;
     if(Package::where('title',$title)->first()){
         return self::toastr(false,"Package Title Already Exit","error","Error");
     }
      $package_details = new Package;
      $package_details->title = $title;
      $package_details->price = $price;
      $package_details->desc  = $desc;
      $save = $package_details->save();
        if($save){
          return self::toastr(true,"Package Added","success","Success");
        }else{
          return self::toastr(false,"Sorry , Technical Issue..","error","Error");
        }
  }
   public function updatePackage(Request $request){
      $title = $request->title;
      $price = $request->price;
      $desc  = $request->desc;
      $package_id = $request->package_id;
      $package_details = Package::find($package_id);
      $package_details->title = $title;
      $package_details->price = $price;
      $package_details->desc  = $desc;
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

    
    $services_data =Service::find($customer_details->customer_service_id);
    $customer_service_id = $customer_details->customer_service_id;
    
    
// Step 1: Fetch the first record that matches the JSON condition
$team_manager_service = DB::table('team_manager_services')  
    ->whereJsonContains('managers_services_id', $customer_service_id) // Assumes it's a JSON array
    ->get();

$main_users = collect(); // Create an empty collection to store all users

foreach ($team_manager_service as $value) {
    $users = MainUserModel::where('id', $value->team_manager_id)->get(['first_name','last_name','id','user_type']);
    $main_users = $main_users->merge($users);
}



    return view('admin.dashboard.view_assign_client',['admin_data'=>$admin_data,'user_type'=>$user_type,'customer_data'=>$customer_details,'team_member'=>$data,'services_data'=>$services_data,'managers'=>$main_users]);
  }
  public function leadsView($customer_id){
     $id = session('admin');
     $admin_data = self::userDetails($id);
     $user_type = self::userType($admin_data->user_type);
     $customer_id =   Crypt::decrypt($customer_id);
     $clients = CustomerModel::find($customer_id);
     $service_data = Service::find($clients->customer_service_id);
     return view('admin.dashboard.leads_view',['admin_data'=>$admin_data,'customer'=>$clients,'user_type'=>$user_type,'service_data'=>$service_data]);
  }
// THIS IS END OF THE CLASS 
}