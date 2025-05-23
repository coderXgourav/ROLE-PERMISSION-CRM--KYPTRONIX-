<?php

namespace App\Http\Controllers;    

use Illuminate\Http\Request;
use App\Models\SuperAdminModel;
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
use DB;
use Crypt;

class SuperContactController extends Controller
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
   
    // THIS IS contactAdd FUNCTION 
    public function contactAdd(Request $request){
     $phone= $request->phone;
      $country_code = $request->country_code;
      $name = $request->name;
      $email = $request->email;
      // $dob = $request->dob;
      $password = $request->password;
      $service =$request->service_id;
     if(UserModel::where('phone_number',$phone)->first()){
         return self::toastr(false,"Number Already Registered","error","Error");
     }
     if(UserModel::where('email',$email)->first()){
         return self::toastr(false,"Email Already Registered","error","Error");
     }

      $contact_details = new UserModel;
      $contact_details->name = $name;
      $contact_details->service_id=$service;
      $contact_details->country_code = $country_code;
      $contact_details->phone_number = $phone;
      $contact_details->email = $email ;
      // $contact_details->dob = $dob ;
      $contact_details->password = $password ;
      $save = $contact_details->save();
      if($save){
         return self::toastr(true,"Team Member Add Successfull","success","Success");
      }else{
         return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      }
      
    }
    // THIS IS contactAdd FUNCTION  

    
    // THIS IS contactPage FUNCTION 
    public function contactPage(){
      $id = session('super_admin');
      $admin_data = SuperAdminModel::find($id);
      $contact_data = DB::table('user')
      ->join('services', 'services.service_id', '=', 'user.service_id')
      ->select('user.*', 'services.name as service_name')
      ->orderBy('user.user_id', 'DESC')
      ->get();
      //$contact_data = UserModel::orderBy('user_id','DESC')->get();
      return view('super_admin.dashboard.contacts',['admin_data'=>$admin_data,'data'=>$contact_data]);
    }
    // THIS IS contactPage FUNCTION 

// THIS IS editUserPage FUNCTION   
  public function editUserPage($contact_id){
    $id = session('super_admin');
   $admin_data = SuperAdminModel::find($id);
   
   $user_id =   Crypt::decrypt($contact_id);
   $data = UserModel::find($user_id);
   $services = Service::orderBy('service_id','DESC')->get();
 return view('super_admin.dashboard.edit_contact',['admin_data'=>$admin_data,'data'=>$data,'services_data'=>$services]);
   
  }
 
// THIS IS editUserPage FUNCTION   

// THIS IS updateContact FUNCTION 
public function updateContact(Request $request){
  
     $phone= $request->phone;
     $country_code=$request->country_code;

      $name = $request->name;
      $email = $request->email;
      // $dob = $request->dob;
      $password = $request->password;
      $service =$request->service_id;
        $user_id = $request->user_id;
     $contact_details = UserModel::find($user_id);
      $contact_details->name = $name;
      $contact_details->service_id = $service;
      $contact_details->phone_number = $phone ;
      $contact_details->email = $email ;
      $contact_details->country_code = $country_code ;
      $contact_details->password = $password ;
      $save = $contact_details->save();
      if($save){
         return self::toastr(true,"Team Member Details Updated Successfull","success","Success");
      }else{
         return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      }
}


// THIS IS updateContact FUNCTION 

// THIS IS A deleteTeam FUNCTION 
public function deleteTeam(Request $request){
    $id = $request->id;
    $delete = UserModel::find($id)->delete();
    if($delete){
  return self::swal(true,'Deleted','success');
    }else{
  return self::swal(false,'Technical Issue','error');
        
    }
}

// THIS IS A deleteTeam FUNCTION 

//  THIS IS Clientspage FUNCTION 
public function Clientspage(){
  $id = session('super_admin');
   $admin_data = SuperAdminModel::find($id);
   $customers = CustomerModel::orderBy('customer_id','DESC')->get();
  return view('super_admin.dashboard.customers',['admin_data'=>$admin_data,'data'=>$customers]);
}
//  THIS IS Clientspage FUNCTION 


//  THIS IS assginClientspage FUNCTION 
public function assginClientspage(){
  $id = session('super_admin');
   $admin_data = SuperAdminModel::find($id);
  $team = UserModel::all();

   $customers = DB::table('user')
   ->join('customer','customer.team_member','=','user.user_id')
   ->where('customer.team_member','!=',null)
   ->orderBy('customer.customer_id','DESC')
   ->get();
  return view('super_admin.dashboard.assign_client',['admin_data'=>$admin_data,'data'=>$customers,'team'=>$team]);
}
//  THIS IS assginClientspage FUNCTION 


//  THIS IS noneAssginClientspage FUNCTION 
public function noneAssginClientspage(){
  $id = session('super_admin');
  $team = UserModel::all();
   $admin_data = SuperAdminModel::find($id);
   $customers = CustomerModel::where('team_member',null)->orderBy('customer_id','DESC')->get();
  return view('super_admin.dashboard.none_assign_client',['admin_data'=>$admin_data,'data'=>$customers,'team'=>$team]);
}
//  THIS IS noneAssginClientspage FUNCTION 

// THIS IS  assign FUNCTION 
public function assign(Request $request){
  $customers[] = $request->customer;
  $team_member = $request->team_member;

// echo "<pre>";
// print_r($customers);

foreach ($customers[0] as $key => $value) {
$update = CustomerModel::find($value);
$update->team_member=$team_member;
$update->save();
}
return self::swal(true,'Assign Successfull','success');
  

}
// THIS IS  assign FUNCTION 
// THIS IS emailPage FUNCTION 
public function emailPage(){
   $id = session('super_admin');
   $admin_data = SuperAdminModel::find($id);

   $emails = DB::table('user')
   ->join('email_send','email_send.email_admin','=','user.user_id')
   ->join('customer','customer.customer_id','=','email_send.email_customer')
   ->orderBy('email_send.email_id','DESC')
   ->paginate(10);
  return view('super_admin.dashboard.all_email',['admin_data'=>$admin_data,'data'=>$emails]);
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


   $id = session('super_admin');
   $admin_data = SuperAdminModel::find($id);
  return view('super_admin.dashboard.email_show',['admin_data'=>$admin_data,'data'=>$email_details[0]]);
  
}
// THIS IS emailShow FUNCTION 


// THIS IS EXPORT FUNCTION 

public function export()
    {
        return Excel::download(new CustomerExport(), 'clients.xlsx');
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
   $id = session('super_admin');
   $admin_data = SuperAdminModel::find($id);
     return view('super_admin.dashboard.import_customer',['admin_data'=>$admin_data]);
}
// THIS IS importPage FUNCTION  


// THIS IS smsPage FUNCTION 
public function smsPage(){
   $id = session('super_admin');
   $admin_data = SuperAdminModel::find($id);

   $sms = DB::table('user')
   ->join('messages','messages.team_member_id','=','user.user_id')
   ->join('customer','customer.customer_id','=','messages.customer_msg_id')
   ->orderBy('messages.messages_id','DESC')
   ->paginate(10);
  return view('super_admin.dashboard.all_sms',['admin_data'=>$admin_data,'data'=>$sms]);
}


// THIS IS smsShow FUNCTION 

public function smsShow($id){
     $team_id = session('super_admin');
   $admin_data = SuperAdminModel::find($team_id);

   
  $sms_id = decrypt($id);
   $sms_details = DB::table('user')
   ->join('messages','messages.team_member_id','=','user.user_id')
   ->join('customer','customer.customer_id','=','messages.customer_msg_id')
   ->where('messages.messages_id',$sms_id)
   ->get();
  //  echo "<pre>";
  // print_r($sms_details);
  // die();

  return view('super_admin.dashboard.sms_show',['admin_data'=>$admin_data,'data'=>$sms_details[0]]);
  
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
      $id = session('super_admin');
      $admin_data = SuperAdminModel::find($id);
      $members_data = DB::table('team_member')
      ->join('services', 'services.service_id', '=', 'team_member.team_service')
      ->select('team_member.*', 'services.name as service_name')
      ->orderBy('team_member.team_member_id', 'DESC')
      ->get();
      return view('super_admin.dashboard.team_member_lists',['admin_data'=>$admin_data,'data'=>$members_data]);
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
      $id = session('super_admin');
      $admin_data = SuperAdminModel::find($id);

      $team_member_id =   Crypt::decrypt($team_member_id);
      $data = TeamMember::find($team_member_id);
      $services = Service::orderBy('service_id','DESC')->get();
      return view('super_admin.dashboard.edit_team_member',['admin_data'=>$admin_data,'data'=>$data,'services_data'=>$services]);
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
    $admin_id = session('super_admin');
    $admin_data = SuperAdminModel::find($admin_id);
   // $user_id =   Crypt::decrypt($id);
    $team_manager=UserModel::find($id);
     $invoice_data = DB::table('user')
    ->select('user.name as team_manager_name','invoices.price as invoices_price','customer.customer_name','customer.customer_number','invoices.created_at','invoices.invoice_id','customer.customer_id','invoices.role')
    ->join('invoices','invoices.team_manager_id','=','user.user_id')
    ->join('customer','customer.customer_id','=','invoices.customer_id')
    ->where('invoices.service_id',$team_manager['service_id'])
    ->where('invoices.team_manager_id',$team_manager['user_id'])
    ->get();   
    // echo '<pre>';
   // print_r($invoice_data);die;
    return view('super_admin.dashboard.invoice_list',['admin_data'=>$admin_data,'team_manager'=>$team_manager,'data'=>$invoice_data]);

  }
  //invoiceList FUNCTION END
  public function viewInvoice($customer_id,$invoice_id){
  $team_id = session('super_admin');
  $admin_data = SuperAdminModel::find($team_id);
  $clients = CustomerModel::find($customer_id);
  $invoice_details = Invoice::find($invoice_id);
  return view('super_admin.dashboard.view_invoice',['admin_data'=>$admin_data,'clients'=>$clients,'invoice_details'=>$invoice_details]);
}
//viewTeamMember FUNCTION START
public function viewTeamMember($team_manager_id){
    $team_id = session('super_admin');
    $admin_data = SuperAdminModel::find($team_id);

    $team_manager_id =   Crypt::decrypt($team_manager_id);
    $data = UserModel::find($team_manager_id);
    $services = Service::find($data['service_id']);
    $total_team_member = TeamMember::where('team_service',$data['service_id'])->count();
    $clients=CustomerModel::where('team_member','=',$data['user_id'])->where('status','=',1)->count();
    $invoice_data=Invoice::where('service_id','=',$data['service_id'])->where('team_manager_id','=',$data['user_id'])->count();
    $convert_to_clients=PaidCustomer::where('team_manager_id',$team_manager_id)->where('role','team_manager')->count();
    return view('super_admin.dashboard.view_team_member',['admin_data'=>$data,'data'=>$data,'services_data'=>$services,'total_team_member'=>$total_team_member,'clients'=>$clients,'invoice_data'=>$invoice_data,'convert_to_clients'=>$convert_to_clients]);
}
//viewTeamMember FUNCTION END
public function teamMemberList($manager_id){
    $team_id = session('super_admin');
    $admin_data = SuperAdminModel::find($team_id);
    $data = UserModel::find($manager_id);
    $services = Service::find($data['service_id']);
    $team_member = DB::table('team_member')
    ->join('services', 'services.service_id', '=', 'team_member.team_service')
    ->select('team_member.*', 'services.name as service_name')
    ->where('team_member.team_service',$data['service_id'])
    ->get();
    return view('super_admin.dashboard.members_list',['admin_data'=>$admin_data,'team_member'=>$team_member]);
}
public function showClientsList($manager_id){
    $team_id = session('super_admin');
    $admin_data = SuperAdminModel::find($team_id);
    $data = UserModel::find($manager_id);
    $services = Service::find($data['service_id']);
    $clients = DB::table('customer')
    ->join('services','services.service_id','=','customer.customer_service_id')
    ->select('customer.*','services.name as service_name')
    ->where('customer.team_member',$manager_id)
    ->where('customer.status',1)
    ->get();
    // print_r($clients);die;
    return view('super_admin.dashboard.clients_list',['admin_data'=>$admin_data,'clients'=>$clients]);
}
public function viewMember($member_id){
    $team_id = session('super_admin');
    $admin_data = SuperAdminModel::find($team_id);
    $member_id =   Crypt::decrypt($member_id);
    $member_data = TeamMember::find($member_id);
    $services = Service::find($member_data['team_service']);
    $invoice_data=Invoice::where('service_id','=',$member_data['team_service'])->where('team_member_id','=',$member_data['team_member_id'])->count();
    $convert_to_clients =PaidCustomer::where('team_member_id','=',$member_id)->where('role','=','team_member')->count();
    return view('super_admin.dashboard.view_member',['admin_data'=>$admin_data,'data'=>$member_data,'services_data'=>$services,'invoice_data'=>$invoice_data,'convert_to_clients'=>$convert_to_clients]);
}
 public function memberInvoiceList($team_member_id){
    $admin_id = session('super_admin');
    $admin_data = SuperAdminModel::find($admin_id);
    $member_data=TeamMember::find($team_member_id);
    $invoice_data = DB::table('team_member')
    ->select('team_member.name as team_member_name','invoices.price as invoices_price','customer.customer_name','customer.customer_number','invoices.created_at','invoices.invoice_id','customer.customer_id','invoices.role')
    ->join('invoices','invoices.team_member_id','=','team_member.team_member_id')
    ->join('customer','customer.customer_id','=','invoices.customer_id')
    ->where('invoices.service_id',$member_data['team_service'])
    ->where('invoices.team_member_id',$member_data['team_member_id'])
    ->get();   
   
    return view('super_admin.dashboard.member_invoice_list',['admin_data'=>$admin_data,'data'=>$invoice_data,'member_data'=>$member_data]);
  }
 public function manager_convert_to_clients_list($manager_id){
     $team_id = session('super_admin');
     $admin_data = SuperAdminModel::find($team_id);
     $data = UserModel::find($manager_id);
     $client_data = DB::table('customer')
     ->select('customer.customer_id','customer.customer_name','customer.customer_number','customer.customer_email','customer.msg')
     ->join('paid_customer','paid_customer.customer_id','=','customer.customer_id')
     ->where('paid_customer.team_manager_id',$manager_id)
     ->where('paid_customer.role','team_manager')
     ->get();
    return view('super_admin.dashboard.manager_convert_to_client_list',['admin_data'=>$admin_data,'client_data'=>$client_data]);
 }
 public function member_convert_to_clients_list($member_id){
     $team_id = session('super_admin');
     $admin_data = SuperAdminModel::find($team_id);
     $data = TeamMember::find($member_id);
     $client_data = DB::table('customer')
     ->select('customer.customer_id','customer.customer_name','customer.customer_number','customer.customer_email','customer.msg')
     ->join('paid_customer','paid_customer.customer_id','=','customer.customer_id')
     ->where('paid_customer.team_member_id',$member_id)
     ->where('paid_customer.role','team_member')
     ->get();
    return view('super_admin.dashboard.member_convert_to_client_list',['admin_data'=>$admin_data,'client_data'=>$client_data]);
 }
 public function viewCustomers(){
     $team_id = session('super_admin');
     $admin_data = SuperAdminModel::find($team_id);
     $client_data =DB::table('customer')
     ->select('customer.customer_id','customer.customer_name','customer.customer_email','customer.customer_number','customer.msg')
     ->join('paid_customer','paid_customer.customer_id','=','customer.customer_id')
     ->get();
     return view('super_admin.dashboard.view_customers',['admin_data'=>$admin_data,'client_data'=>$client_data]);
 }

// THIS IS END OF THE CLASS 
}