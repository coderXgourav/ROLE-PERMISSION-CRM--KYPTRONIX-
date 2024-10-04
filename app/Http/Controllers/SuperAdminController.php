<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperAdminModel; 
use App\Models\CustomerModel; 
use App\Models\UserModel; 
use App\Models\EmailModel; 
use App\Models\MessageModel; 
use App\Models\Service; 
use App\Models\TeamMember; 
use Mail;

class SuperAdminController extends Controller
{
    //  THIS IS A login FUNCITON 
    public function login(Request $request){
       $username = $request->username;
       $password = $request->password;
       $check_username = SuperAdminModel::where('email',$username)->orWhere('username',$username)->first();
       if($check_username){
         if($check_username->password==$password){
            session()->put('super_admin',$check_username->id);
       return self::swal(true,'Login Successfull','success');
         }else{
       return self::swal(false,'Invalid Password','error');
         }
       }else{
       return self::swal(false,'Invalid Username or Email','error');
       }

    }
    //  THIS IS A login FUNCITON 


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

//  THIS IS dashboardPage FUNCTIOIN 
public function dashboardPage(){
  $id = session('super_admin');
   $admin_data = SuperAdminModel::find($id);

  $customer_count = CustomerModel::count();
  $assign_clients_count = CustomerModel::where('team_member','!=',null)->count();
  $none_assign_clients_count = CustomerModel::where('team_member','=',null)->count();
  $team_member_count = TeamMember::count();
  $email_send_cound = EmailModel::count();
  $sms_count = MessageModel::count();

   return view('super_admin.dashboard.index',['admin_data'=>$admin_data,'total_customer'=>$customer_count,'assign_customer'=>$assign_clients_count,'none_assign_customer'=>$none_assign_clients_count,'team_member'=>$team_member_count,'total_email'=>$email_send_cound,'sms_count'=>$sms_count]);
    
}
//  THIS IS dashboardPage FUNCTIOIN 

// THIS IS A chnagePasswordPage FUNCITON 
public function chnagePasswordPage(){
   $id = session('super_admin');
   $admin_data = SuperAdminModel::find($id);
  return view('admin.dashboard.change_password',['admin_data'=>$admin_data]);
  
}
// THIS IS A chnagePasswordPage FUNCITON 
// THIS IS A logout FUNCTION 


// THIS IS A logout FUNCTION 
public function logout(){
  session()->forget('super_admin');
  return redirect('/super-admin');
}
// THIS IS A logout FUNCTION 

// THIS IS changePassword FUNCTION 
public function changePassword(Request $request){
  $old = $request->old;
  $new = $request->new;
  $confirm = $request->confirm;
  $check_old_password = SuperAdminModel::find(session('super_admin'));
  if($check_old_password->password==$old){
    $check_old_password->password = $confirm;
    $save = $check_old_password->save();
    if($save){
 return self::toastr(true,"Your Old Password Updated Successfull","success","Success");
    }else{
       return self::toastr(false,"Technical Issue..!","error","Error");
    }
    
    

  }else{
    return self::toastr(false,"Invalid Old Password..!","error","Error");
  }
  
}
// THIS IS changePassword FUNCTION 

// THIS IS forgotCheck
public function forgotCheck(Request $request){
  $email = $request->email;
  $check_email = SuperAdminModel::where('email',$email)->first();
   if($check_email){
   $otp = rand(1111,9999);
   $check_email->otp = $otp;
   $send = $check_email->save();
   if($send){
    session()->put('admin_forgot_id',$check_email->id);
    $data = ['otp'=>$otp];
    $user['to'] = $email;
    Mail::send('admin.mail',$data,function($messages)use($user)
    {$messages->to($user['to']);
      $messages->subject('Forgot Password');
    });
  
    return self::toastr(true,"OTP Send On Your Email ","success","Success");
    
   }else{
    return self::toastr(false,"Technical Issue..!","error","Error");
   }

   }else{
    return self::toastr(false,"Invalid Email Id ..!","error","Error");
  }

}
// THIS IS forgotCheck  

// THIS IS otpCheck FUNCTION 
public function otpCheck(Request $request){
  $otp = $request->otp;
    $id = session('admin_forgot_id');
    $db_otp = SuperAdminModel::find($id);
    if($db_otp->otp==$otp){
    return self::toastr(true,"OTP Match Successfull","success","Success");
    }else{
      return self::toastr(false,"OTP Not Match ,Please Enter Correct OTP","error","Error");
    }
}
// THIS IS otpCheck FUNCTION 

// THIS IS A newPassword FUNCTION 
public function newPassword(Request $request){
  $new = $request->new_password;
  $confirm = $request->confirm_password;
   $admin_data = SuperAdminModel::find(session('admin_forgot_id'));
  $admin_data->password = $confirm;
  if($admin_data->save()){
   return self::swal(true,'Password Updated','success');
  }else{
   return self::swal(false,'Technical Issue..!','error');

  }


}
// THIS IS A newPassword FUNCTION 

// THIS IS addContactPage FUNCTION  
public function addContactPage(){
    $id = session('super_admin');
    $admin_data = SuperAdminModel::find($id);
    $services = Service::orderBy('service_id','DESC')->get();
    return view('super_admin.dashboard.add_contact',['admin_data'=>$admin_data,'services_data'=>$services]);
}
// THIS IS addContactPage FUNCTION  

// THIS IS  changeUsername FUNCTION 
public function changeUsernamePage(){
    $id = session('super_admin');
   $admin_data = SuperAdminModel::find($id);
    return view('super_admin.dashboard.change_username',['admin_data'=>$admin_data]);
}
// THIS IS  changeUsername FUNCTION 
// THIS IS changeUsername FUNCTION \

public function changeUsername(Request $request){
  $email = $request->new_email; 
  $username = $request->new_username;
  $name = $request->new_name;
  $update_data = SuperAdminModel::find(session('super_admin'));
  if($email!=""){
   $update_data->email= $email;
  }
  if($username!=""){
   $update_data->username= $username;
  }
  if($name!=""){
   $update_data->name= $name;
  }
 if($name==""&&$email==""&&$username==""){
   return self::toastr(false,"Sorry..Noting For Update","error","Error");
 }else{
  $update_data->save();
   return self::toastr(true,"Details Updated Successfull","success","Success");

 }

}
// THIS IS changeUsername FUNCTION 

// THIS IS addServicePage FUNCTION  
public function addServicePage(){
  $id = session('super_admin');
 $admin_data = SuperAdminModel::find($id);
  return view('super_admin.dashboard.add_service',['admin_data'=>$admin_data]);
}
// THIS IS addServicePage FUNCTION  
// THIS IS addTeamMember FUNCTION  
public function addTeamMember(){
    $id = session('super_admin');
    $admin_data = SuperAdminModel::find($id);
    $services = Service::orderBy('service_id','DESC')->get();
    return view('super_admin.dashboard.add_team_member',['admin_data'=>$admin_data,'services_data'=>$services]);
}
// THIS IS addTeamMember FUNCTION  
    

// THIS IS END OF CLASS 
 
}