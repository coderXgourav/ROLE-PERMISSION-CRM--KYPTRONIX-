<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\UserModel;
use App\Models\CustomerModel;
use App\Models\EmailModel;
use Twilio\Rest\Client; 
use App\Models\MessageModel;
use App\Models\Service; 
use App\Models\TeamMember; 
use App\Models\RemarkModel;
use App\Models\EmailTemplate;
use App\Models\Invoice;
use App\Models\PaidCustomer;
use DB;

use Crypt;
use Mail;

class TeamController extends Controller
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

     //  THIS IS A login FUNCITON 
    public function login(Request $request){
       $username = $request->email_phone;
       $password = $request->password;
       $check_username = UserModel::where('email',$username)->orWhere('phone_number',$username)->first();
       if($check_username){
         if($check_username->password==$password){
            session()->put('team',$check_username->user_id);
       return self::swal(true,'Login Successfull','success');
         }else{
       return self::swal(false,'Invalid Password','error');
         }
       }else{
       return self::swal(false,'Invalid Email or Number','error');
       }

    }
    //  THIS IS A login FUNCITON 


    //   THIS IS A dashboard FUNCTION 
    public function dashboard(){
        $id = session('team');
        $admin_data = UserModel::find($id);
        $email_send_cound = EmailModel::where('email_admin',$id)->count();
        $sms_count = MessageModel::where('team_member_id',$id)->count();
        $team_members = DB::table('team_member')
        ->select('team_member.*')
        ->where('team_member.team_service',$admin_data['service_id'])
        ->count();
        $assign_clients = DB::table('team_member')
        ->join('customer','customer.team_member','=','team_member.team_member_id')
        ->where('customer.team_member','=',$admin_data['user_id'])
        ->count();
        $none_assign_clients = CustomerModel::where('team_member',null)->where('customer_service_id',$admin_data['service_id'])->count();
        $clients = CustomerModel::where('customer_service_id',$admin_data['service_id'])->count();

       return view('team.dashboard.index',['admin_data'=>$admin_data,'clients'=>$clients,'email_send_cound'=>$email_send_cound,'sms_count'=>$sms_count,'team_members'=>$team_members,'assign_client'=>$assign_clients,'none_assign'=>$none_assign_clients]);
    }
    //   THIS IS A dashboard FUNCTION 


//  THIS IS changeUsernamePage FUNCTION 
public function changeUsernamePage(){
     $id = session('team');
        $admin_data = UserModel::find($id);
       return view('team.dashboard.change_username',['admin_data'=>$admin_data]);
}

//  THIS IS changeUsernamePage FUNCTION 
public function changeUsername(Request $request){
  $email = $request->new_email; 
  $name = $request->new_name;
  $number = $request->new_number;
  $update_data = UserModel::find(session('team'));
  if($email!=""){
   $update_data->email= $email;
  }
  if($number!=""){
   $update_data->phone_number= $number;
  }
  if($name!=""){
   $update_data->name= $name;
  }
 if($name==""&&$email==""&&$number==""){
   return self::toastr(false,"Sorry..Noting For Update","error","Error");
 }else{
  $update_data->save();
   return self::toastr(true,"Details Updated Successfull","success","Success");

 }

}
// THIS IS changeUsername FUNCTION 
// THIS IS A chnagePasswordPage FUNCITON 
public function chnagePasswordPage(){
   $id = session('team');
   $admin_data = UserModel::find($id);
  return view('team.dashboard.change_password',['admin_data'=>$admin_data]);
  
}
// THIS IS A chnagePasswordPage FUNCITON 
// THIS IS changePassword FUNCTION 
public function changePassword(Request $request){
  $new = $request->new;
  $confirm = $request->confirm;
  $check_old_password = UserModel::find(session('team'));
  $check_old_password->password=$confirm;
  $check_old_password->save();
  return self::toastr(true,'Updated Successfull','success',"Success");
  
}

// THIS IS changePassword FUNCTION 

// THIS IS addCustomer FUNCTION 
public function addCustomer(){
      $id = session('team');
   $admin_data = UserModel::find($id);
    return view('team.dashboard.add_customer',['admin_data'=>$admin_data]);
}
// THIS IS addCustomer FUNCTION 

   // THIS IS customerAdd FUNCTION 
    public function customerAdd(Request $request){
     $phone= $request->phone;
     $country_code = $request->country_code;
     $a = $country_code.$phone;

      $name = $request->name;
      $email = $request->email;
      $msg = $request->msg;
      $service_id =$request->customer_service_id;
      $team_member_id =$request->team_member;
      $team_member = session('team');
     

      $contact_details = new CustomerModel;
      $contact_details->customer_name = $name;
      $contact_details->customer_number = $a ;
      $contact_details->customer_email = $email ;
      $contact_details->msg = $msg ;
      $contact_details->task = 1 ;
      $contact_details->customer_service_id = $service_id;
      $contact_details->team_member = $team_member_id;
      $save = $contact_details->save();
      if($save){
         return self::toastr(true,"Customer Add Successfull","success","Success");
      }else{
         return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      }
      
    }
    // THIS IS customerAdd FUNCTION 

        // THIS IS contactPage FUNCTION 
    public function myCustomer(){
      $id = session('team');
      $admin_data = UserModel::find($id);
      $leads_data = DB::table('customer')
      ->select('customer.customer_id', 'customer.customer_name', 'customer.customer_number', 'customer.customer_email', 'user.user_id', 'customer.msg')
      ->join('user', 'user.user_id', '=', 'customer.team_member')
      ->leftJoin('paid_customer', function ($join)  use ($admin_data) {
          $join->on('paid_customer.customer_id', '=', 'customer.customer_id')
               ->where('paid_customer.team_manager_id',$admin_data['user_id']);
      })
      ->where('user.user_id', $admin_data['user_id'])
      ->where('customer.status',1)
      ->where('customer.customer_service_id',$admin_data['service_id'])
      ->get();         
     // echo '<pre>';
     // print_r($leads_data);die;

     // $contact_data = CustomerModel::where('customer_service_id',$admin_data['service_id'])->orderBy('customer_id','DESC')->get();
      return view('team.dashboard.customer',['admin_data'=>$admin_data,'data'=>$leads_data]);
    }
    // THIS IS contactPage FUNCTION 
    // THIS IS A logout FUNCTION 
public function logout(){
  session()->forget('team');
  return redirect('/team');
}
// THIS IS A logout FUNCTION 

//  THIS IS emailText FUNCTION 
public function emailText($customer_id){
   $id = session('team');
   $admin_data = UserModel::find($id);
   $customer_id = decrypt($customer_id);
  return view('team.dashboard.email_text',['admin_data'=>$admin_data,'id'=>$customer_id]);
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
    
  $send =   Mail::send('team.dashboard.mail',$data,function($messages)use($user)
    {$messages->to($user['to']);
      $messages->subject('Business Email');
    });
  if($send){
    $save = new EmailModel;
    $save->email_admin = session('team');
    $save->email_customer = $id;
    $save->email_text = $msg;
    $save->save();
   return self::toastr(true,'Email Send Successfull','success','Success');
  }else{
   return self::toastr(false,'Please Try again Later','error','Error');
  }
  
  
}
// THIS IS emailSendToClient FUNCTION 

// THIS IS A SEND_SMS FUNCTION 
public function sendSms(Request $request){
  // THIS IS API GET VARIABLE
      //  $accountSid = "ACb53550cfac05a2110c1a988e796c9544";
      //   $authToken = "9f903c65e194656fa42ec29934f013ef";
      //   $twilioNumber = "+12179552567";

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
          $save -> team_member_id = session('team');
          $save -> customer_msg_id = $customer_id;
          $save -> message = $message;
          $save->save();
          return self::toastr(true,'Message Send Successfull','success','Success');

        }else{
          return self::toastr(false,'Message Not Sending','error','Error');

        }

      }
// THIS IS A SEND_SMS FUNCTION  

// THIS IS A makeCall FUNCITON 
 public function makeCall(Request $request)
    {
        $accountSid = "ACb53550cfac05a2110c1a988e796c9544";
        $authToken = "9f903c65e194656fa42ec29934f013ef";
        $twilioPhoneNumber = "+12179552567";
        
        $client = new Client($accountSid, $authToken);
        
        $call = $client->calls->create(
          +916296665907,
            $twilioPhoneNumber,
            [
                'url' => 'http://127.0.0.1:8000/twilio/voice',
                'method' => 'GET',
            ]
        );
        
        return response()->json(['message' => 'Call initiated successfully']);
    }

// THIS IS A makeCall FUNCITON 
// THIS IS handleVoice FUNCTION 
public function handleVoice(Request $request)
{
    $voiceResponse = new \Twilio\TwiML\VoiceResponse();
    $voiceResponse->say('this is trial call from kyptronix llp');

    return response($voiceResponse)->header('Content-Type', 'application/xml');
}
// THIS IS handleVoice FUNCTION 

//  THIS IS messageText FUNCTION 

public function messageText($customer_id){
   $id = session('team');
   $admin_data = UserModel::find($id);
   $customer_id = decrypt($customer_id);
  return view('team.dashboard.text_msg',['admin_data'=>$admin_data,'id'=>$customer_id]);
}
//  THIS IS messageText FUNCTION 

// THIS IS REDIRECT CALLING PAGE FUNCTION 
public function callPage($customer_id){
   $id = session('team');
   $admin_data = UserModel::find($id);
   $customer_id = decrypt($customer_id);

   $user_data = CustomerModel::find($customer_id);
   $number = $user_data->customer_number;
   $name = $user_data->customer_name;

  return view('team.dashboard.call',['admin_data'=>$admin_data,'id'=>$customer_id,'call_number'=>$number,'name'=>$name]);
}
// THIS IS REDIRECT CALLING PAGE FUNCTION 



// THIS IS myEmail FUNCTION 
public function myEmail(){
   $id = session('team');
   $admin_data = UserModel::find($id);

   $emails = DB::table('user')
   ->join('email_send','email_send.email_admin','=','user.user_id')
   ->join('customer','customer.customer_id','=','email_send.email_customer')
   ->orderBy('email_send.email_id','DESC')
   ->where('user.user_id',$id)
   ->paginate(10);
  return view('team.dashboard.all_email',['admin_data'=>$admin_data,'data'=>$emails]);
}
// THIS IS myEmail FUNCTION

// THIS IS emailShow FUNCTION 

public function emailShow($email_id){
  $email_id = decrypt($email_id);
   $email_details = DB::table('user')
   ->join('email_send','email_send.email_admin','=','user.user_id')
   ->join('customer','customer.customer_id','=','email_send.email_customer')
   ->where('email_send.email_id',$email_id)
   ->get();

   $id = session('team');
   $admin_data = UserModel::find($id);
  return view('team.dashboard.email_show',['admin_data'=>$admin_data,'data'=>$email_details[0]]);
  
}
// THIS IS emailShow FUNCTION 

// THIS IS smsPage FUNCTION 
public function smsPage(){
   $id = session('team');
   $admin_data = UserModel::find($id);

   $sms = DB::table('user')
   ->join('messages','messages.team_member_id','=','user.user_id')
   ->join('customer','customer.customer_id','=','messages.customer_msg_id')
   ->orderBy('messages.messages_id','DESC')
   ->where('user.user_id',$id)
   ->paginate(10);
  return view('team.dashboard.all_sms',['admin_data'=>$admin_data,'data'=>$sms]);
}

// THIS IS smsShow FUNCTION 

public function smsShow($id){
     $team_id = session('team');
   $admin_data = UserModel::find($team_id);

   
  $sms_id = decrypt($id);
   $sms_details = DB::table('user')
   ->join('messages','messages.team_member_id','=','user.user_id')
   ->join('customer','customer.customer_id','=','messages.customer_msg_id')
   ->where('messages.messages_id',$sms_id)
   ->where('user.user_id',$team_id)
   ->get();
  //  echo "<pre>";
  // print_r($sms_details);
  // die();

  return view('team.dashboard.sms_show',['admin_data'=>$admin_data,'data'=>$sms_details[0]]);
  
}
// THIS IS smsShow FUNCTION 
// THIS IS templateChoose FUNCTION 
  public function templateChoose($id){
   $team_id = session('team');
   $admin_data = UserModel::find($team_id);
   
   $customer_id = decrypt($id);
   $user_data = CustomerModel::find($customer_id);
   
  return view('team.dashboard.email_template',['admin_data'=>$admin_data,'id'=>$id,'data'=>$user_data]);
    
  }
// THIS IS templateChoose FUNCTION 
// THIS IS emailSending FUNCTION 
public function emailSending(Request $request){
  echo "<pre>";
  print_r($request);
}
// THIS IS emailSending FUNCTION 
// THIS IS teamMemberAdd FUNCTION  
public function teamMemberAdd(){
    $team_id = session('team');
    $admin_data = UserModel::find($team_id);
    $services = Service::orderBy('service_id','DESC')->get();
    return view('team.dashboard.add_team_member',['admin_data'=>$admin_data,'services_data'=>$services]);
}
// THIS IS teamMemberAdd FUNCTION 
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
 // THIS IS create_team_members FUNCTION   
 // TeamMembersLists FUNCTION Start
 public function teammembersLists(){
     $team_id = session('team');
     $admin_data = UserModel::find($team_id);
     $members_data = DB::table('team_member')
    ->select('team_member.*')
    ->orderBy('team_member.team_member_id', 'DESC')
    ->where('team_member.team_service',$admin_data['service_id'])
    ->paginate(10);
    return view('team.dashboard.team_member_lists',['admin_data'=>$admin_data,'data'=>$members_data]);
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
    $team_id = session('team');
    $admin_data = UserModel::find($team_id);

    $team_member_id =   Crypt::decrypt($team_member_id);
    $data = TeamMember::find($team_member_id);
    $services = Service::orderBy('service_id','DESC')->get();
    return view('team.dashboard.edit_team_member',['admin_data'=>$admin_data,'data'=>$data,'services_data'=>$services]);
  }
// THIS IS updateMembers FUNCTION   
 public function updateMembers(Request $request){
  
     $phone= $request->phone;
     $country_code=$request->country_code;

      $name = $request->name;
      $email = $request->email;
      $password = $request->password;
      $team_member_id = $request->team_member_id;
      $member_details = TeamMember::find($team_member_id);
      $member_details->name = $name;
      $member_details->phone_number = $phone ;
      $member_details->email = $email ;
      $member_details->country_code = $country_code ;
      $member_details->password = $password ;
      $save = $member_details->save();
      if($save){  
         return self::toastr(true,"Team Member Details Updated Successfull","success","Success");
      }else{ 
         return self::toastr(false, "Sorry , Technical Issue..","error","Error");
      }
  }
  // noneAssginClients FUNCTION START
  public function noneAssginClients(){
   $team_id = session('team');
   $admin_data = UserModel::find($team_id);
  // $team = TeamMember::all();
   $team = TeamMember::where('team_service',$admin_data['service_id'])->get();

   $clients = CustomerModel::where('team_member',null)->where('customer_service_id',$admin_data['service_id'])->orderBy('customer_id','DESC')->get();
   return view('team.dashboard.none_assign_client',['admin_data'=>$admin_data,'data'=>$clients,'team'=>$team]);
 }
// noneAssginClients FUNCTION END
// assign FUNCTION START
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
// assign FUNCTION END 
// assginClients FUNCTION START
public function assginClients(){
   $team_id = session('team');
   $admin_data = UserModel::find($team_id);
  // $team = TeamMember::all();
   $team = TeamMember::where('team_service',$admin_data['service_id'])->get();
   $customers = DB::table('team_member')
   ->join('customer','customer.team_member','=','team_member.team_member_id')
   ->where('customer.customer_service_id','=',$admin_data['service_id'])
   ->orderBy('customer.customer_id','DESC')
   ->get();
  return view('team.dashboard.assign_client',['admin_data'=>$admin_data,'data'=>$customers,'team'=>$team]);
}
// assginClients FUNCTION END
//Remark FUNCTION START
public function remarks(Request $request){
  $customer_id = $request->customer_id;
  $team_member_id = $request->team_member_id;
  $team_manager_id = $request->team_manager_id;
  $remark =$request->remark;
  $role=$request->role;
  $remark_details = new RemarkModel;
  $remark_details->customer_id =$customer_id;
  $remark_details->team_member_id=$team_member_id;
  $remark_details->remark=$remark;
  $remark_details->role=$role;
  $remark_details->team_manager_id=$team_manager_id;

  $save = $remark_details->save();
      if($save){
          return self::toastr(true,"Remark Added","success","Success");
      }else{
         return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      }

}
//Remark FUNCTION END
//chatShow FUNCTION START
public function chatShow($customer_id){
   $team_id = session('team');
   $admin_data = UserModel::find($team_id);
   $customer_id =   Crypt::decrypt($customer_id);
   $customers = DB::table('customer')
   ->join('remark','remark.customer_id','=','customer.customer_id')
   ->where('customer.customer_id','=',$customer_id)
   ->get();
   $clients = CustomerModel::find($customer_id);
   return view('team.dashboard.chat',['admin_data'=>$admin_data,'data'=>$customers,'customer'=>$clients]);
}
//chatShow FUNCTION END 
//emailTemplate FUNCTION START
public function emailTemplate(){
   $id = session('team');
   $admin_data = UserModel::find($id);
   return view('team.dashboard.add_email_template',['admin_data'=>$admin_data]);
}
//emailTemplate FUNCTION END
//sendEmailTemplate FUNCTION START
public function sendEmailTemplate(Request $request){
   $team_manager_id = $request->team_manager_id;
   $service_id = $request->service_id;
   $mail_txt = $request->editor2;
   $email_title = $request->email_title;
   if($mail_txt==""){
      return self::toastr(false,' Text Field is blank , Please Text email','error','Error');
   }
   $email_template_details = new  EmailTemplate;
   $email_template_details->email_text = $mail_txt;
   $email_template_details->team_manager_id = $team_manager_id;
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
   $team_id = session('team');
   $admin_data = UserModel::find($team_id);
   $template_data =EmailTemplate::where('team_manager_id',$admin_data['user_id'])->get();
   return view('team.dashboard.all_email_template',['admin_data'=>$admin_data,'data'=>$template_data]);
}
//allEmailTemplate FUNCTION END
//emailTemplateShow FUNCTION START
public function emailTemplateShow($email_template_id ){
  $email_template_id  = decrypt($email_template_id );
  $email_template_details = DB::table('user')
   ->join('email_templates','email_templates.team_manager_id','=','user.user_id')
   ->where('email_templates.email_template_id',$email_template_id)
   ->get();
   $id = session('team');
   $admin_data = UserModel::find($id);
  return view('team.dashboard.email_template_show',['admin_data'=>$admin_data,'data'=>$email_template_details[0]]);  
}
//emailTemplateShow FUNCTION END
//viewTeamMember FUNCTION START
 public function viewTeamMember($team_member_id){
    $team_id = session('team');
    $admin_data = UserModel::find($team_id);

    $team_member_id =   Crypt::decrypt($team_member_id);
    $data = TeamMember::find($team_member_id);
    $services = Service::find($admin_data['service_id']);

    $assign_client = CustomerModel::where('team_member',$team_member_id)->count();
    $total_invoice=Invoice::where('team_member_id',$team_member_id)->where('service_id',$data['team_service'])->count(); 
    $convert_to_client =PaidCustomer::where('team_member_id',$team_member_id)->where('role','team_member')->count();
    return view('team.dashboard.view_team_member',['admin_data'=>$admin_data,'data'=>$data,'services_data'=>$services,'assign_client'=>$assign_client,'total_invoice'=>$total_invoice,'convert_to_client'=>$convert_to_client]);
  }
//viewTeamMember FUNCTION END
//editEmailTemplate FUNCTION START
  public function editEmailTemplate($email_template_id){
    $team_id = session('team');
    $admin_data = UserModel::find($team_id);
    $data = EmailTemplate::find($email_template_id);
   return view('team.dashboard.edit_email_template',['admin_data'=>$admin_data,'data'=>$data]);
   
  }
  //editEmailTemplate FUNCTION END
  //updateEmailTemplate FUNCTION START
  public function updateEmailTemplate(Request $request){
      $mail_txt = $request->editor2;
      $email_title = $request->email_title;
      $email_template_id = $request->email_template_id;
      $template_details = EmailTemplate::find($email_template_id);
      $template_details->email_title = $email_title;
      $template_details->email_text = $mail_txt;
      $save = $template_details->save();
      if($save){
         return self::toastr(true,"Email Template Updated Successfull","success","Success");
      }else{
         return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      }
  }
  //updateEmailTemplate FUNCTION END
  public function invoiceList(){
     $team_id = session('team');
     $admin_data = UserModel::find($team_id);
     $invoice_data = DB::table('team_member')
    ->select('team_member.name as team_member_name','invoices.price as invoices_price','customer.customer_name','customer.customer_number','invoices.created_at','invoices.invoice_id','customer.customer_id')
    ->join('invoices','invoices.team_member_id','=','team_member.team_member_id')
    ->join('customer','customer.customer_id','=','invoices.customer_id')
    ->where('team_member.team_service',$admin_data['service_id'])
    ->get();
     //echo '<pre>';
    // print_r($invoice_data);die;
    return view('team.dashboard.invoice_list',['admin_data'=>$admin_data,'data'=>$invoice_data]);
 }
 public function viewInvoice($customer_id,$invoice_id){
    $team_id = session('team');
    $admin_data = UserModel::find($team_id);
    $clients = CustomerModel::find($customer_id);
    $invoice_details = Invoice::find($invoice_id);
    return view('team.dashboard.view_invoice',['admin_data'=>$admin_data,'clients'=>$clients,'invoice_details'=>$invoice_details]);
}
public function assignClientList($team_member_id){
   $team_id = session('team');
   $admin_data = UserModel::find($team_id);
   $customers = DB::table('team_member')
   ->join('customer','customer.team_member','=','team_member.team_member_id')
   ->where('customer.team_member','=',$team_member_id)
   ->orderBy('customer.customer_id','DESC')
   ->get();
  return view('team.dashboard.assign_client_list',['admin_data'=>$admin_data,'data'=>$customers]);
}
public function invoices($team_member_id){
     $team_id = session('team');
     $admin_data = UserModel::find($team_id);
     $data = TeamMember::find($team_member_id);
     $invoice_data = DB::table('team_member')
    ->select('team_member.name as team_member_name','invoices.price as invoices_price','customer.customer_name','customer.customer_number','invoices.created_at','invoices.invoice_id','customer.customer_id','invoices.role')
    ->join('invoices','invoices.team_member_id','=','team_member.team_member_id')
    ->join('customer','customer.customer_id','=','invoices.customer_id')
    ->where('invoices.service_id',$data['team_service'])
    ->where('invoices.team_member_id',$data['team_member_id'])
    ->get();   
    return view('team.dashboard.invoices',['admin_data'=>$admin_data,'team_member'=>$data,'data'=>$invoice_data]);
 }

 public function showInvoices($customerId){

  $id = session('team');
  
  $admin_data = UserModel::find($id);

  $data = DB::table('invoices')
  ->join('customer','customer.customer_id','=','invoices.customer_id')
  ->join('team_member','team_member.team_member_id','=','invoices.team_member_id')
  ->where('customer.customer_id',$customerId)->get();

  // echo "<pre>";
  // print_r($data);
  // die();

  if($data){
    return view('team.dashboard.show_invoices',['admin_data'=>$admin_data,'data'=>$data]);

  }else{
    return redirect('/team/invoice');
  }

}

public function invoiceShow($customer_id,$invoice_id){
  $team_id = session('team');
  $admin_data = UserModel::find($team_id);
  $clients = CustomerModel::find($customer_id);
  $invoice_details = Invoice::find($invoice_id);

  return view('team.dashboard.invoice',['admin_data'=>$admin_data,'clients'=>$clients,'invoice_details'=>$invoice_details]);

}
public function createInvoice($customer_id){
  $id = session('team');
  $admin_data = UserModel::find($id);
  $data = CustomerModel::find($customer_id);
 return view('team.dashboard.create_invoice',['admin_data'=>$admin_data,'data'=>$data]);
}
public function invoiceAdd(Request $request){
      $team_member = session('team');
      $date = $request->date;
      $price = $request->price;
      $description=$request->description;
      $customer_id=$request->customer_id;
      $team_manager_id=$request->team_manager_id;
      $role=$request->role;
      $service_id=$request->service_id;

      $invoice_details = new Invoice;
      $invoice_details->price = $price;
      $invoice_details->date = $date;
      $invoice_details->customer_id = $customer_id;
      $invoice_details->description = $description;
      $invoice_details->team_manager_id = $team_manager_id;
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
public function invoice2($customer_id,$invoice_id){
  $team_id = session('team');
  $admin_data = UserModel::find($team_id);
  $clients = CustomerModel::find($customer_id);
  $invoice_details = Invoice::find($invoice_id);
  return view('team.dashboard.invoice2',['admin_data'=>$admin_data,'clients'=>$clients,'invoice_details'=>$invoice_details]);

}
public function convertToClient(Request $request){
      $team_member = session('team');
      $customer_id = $request->customer_id;
      $team_manager_id = $request->team_manager_id;
      $role = $request->role;
      $paid_customer_details = new PaidCustomer;
      $paid_customer_details->customer_id = $customer_id;
      $paid_customer_details->team_manager_id = $team_manager_id;
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
 public function viewClients(){
      $id = session('team');
      $admin_data = UserModel::find($id);
      $client_data = DB::table('user')
      ->select('customer.customer_id','customer.customer_name','customer.customer_number','customer.customer_email','user.user_id','customer.msg','paid_customer.paid_customer_id')
      ->join('customer','customer.team_member','=','user.user_id')
      ->join('paid_customer','paid_customer.customer_id','=','customer.customer_id')
      ->where('user.user_id',$admin_data['user_id'])
      ->where('paid_customer.team_manager_id',$admin_data['user_id'])
      ->where('customer.status',0)
      ->get();
     // echo '<pre>';
     // print_r($client_data);
      return view('team.dashboard.view_clients',['admin_data'=>$admin_data,'data'=>$client_data]);
 }
 public function convert_to_client_list($team_member_id){
     $team_id = session('team');
     $admin_data = UserModel::find($team_id);
     $data = TeamMember::find($team_member_id);
     $client_data = DB::table('customer')
     ->select('customer.customer_id','customer.customer_name','customer.customer_number','customer.customer_email','customer.msg')
     ->join('paid_customer','paid_customer.customer_id','=','customer.customer_id')
     ->where('paid_customer.team_member_id',$team_member_id)
     ->where('paid_customer.role','team_member')
     ->get();
    return view('team.dashboard.convert_to_client_list',['admin_data'=>$admin_data,'team_member'=>$data,'client_data'=>$client_data]);
 }



// THIS IS END OF CLASS 
    
}