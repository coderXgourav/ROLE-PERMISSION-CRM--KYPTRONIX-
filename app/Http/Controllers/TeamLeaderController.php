<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\UserModel;
use App\Models\CustomerModel;
use App\Models\EmailModel;
use Twilio\Rest\Client; 
use App\Models\MessageModel;

use DB;

use Crypt;
use Mail;

class TeamLeaderController extends Controller
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
        $work = CustomerModel::where('team_member',$id)->count();
        $email_send_cound = EmailModel::where('email_admin',$id)->count();
         $sms_count = MessageModel::where('team_member_id',$id)->count();

       return view('team.dashboard.index',['admin_data'=>$admin_data,'work'=>$work,'email_send_cound'=>$email_send_cound,'sms_count'=>$sms_count]);
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
      $team_member = session('team');
     

      $contact_details = new CustomerModel;
      $contact_details->customer_name = $name;
      $contact_details->customer_number = $a ;
      $contact_details->customer_email = $email ;
      $contact_details->msg = $msg ;
      $contact_details->task = 1 ;
      $contact_details->team_member = $team_member ;
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
   $contact_data = CustomerModel::where('team_member',$id)->orderBy('customer_id','DESC')->get();
  return view('team.dashboard.customer',['admin_data'=>$admin_data,'data'=>$contact_data]);
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
       $accountSid = "ACb53550cfac05a2110c1a988e796c9544";
        $authToken = "9f903c65e194656fa42ec29934f013ef";
        $twilioNumber = "+12179552567";
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
    // THIS IS END OF CLASS 
    
}