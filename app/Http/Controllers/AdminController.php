<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel; 
use App\Models\CustomerModel; 
use App\Models\UserModel; 
use App\Models\EmailModel; 
use App\Models\MessageModel; 
use App\Models\Service; 
use App\Models\TeamMember; 
use App\Models\MainUserModel; 
use App\Models\TeamManagersServicesModel; 
use App\Models\MemberServiceModel; 
use App\Models\LoginHistoryModel; 
use GuzzleHttp\Client;
use App\Models\Subservice;
use App\Models\Role;
use App\Models\RoleService;

use App\Models\Package;
use Mail;
use DB;
use Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


class AdminController extends Controller
{
    //  THIS IS A login FUNCITON 
public function decodeBase64Image($base64_image)
{
    // Separate the image data and the MIME type
    $image_parts = explode(';base64,', $base64_image);
    $image_data = base64_decode($image_parts[1]);

    // Define the file name and folder path (customize the path as needed)
    $fileName = 'image_' . time() . '.jpg';  // Use a unique name to prevent overwriting
    $filePath = public_path('staff_images/' . $fileName);  // Save to 'public/images' folder

    // Ensure the directory exists
    if (!file_exists(public_path('staff_images'))) {
        mkdir(public_path('staff_images'), 0777, true);  // Create folder if it doesn't exist
    }

    // Save the image data directly using file_put_contents
    file_put_contents($filePath, $image_data);

    return $fileName;  // Return only the file name
}

 
    
    public function login(Request $request){
      $base64_image  = $request->photo;
       $fileName = self::decodeBase64Image($base64_image);
      $fileName = "";
       
       $username = $request->email_username;
       $password = $request->password;
       
       $check_username = MainUserModel::where('account_name',$username)->orWhere('email_address',$username)->first();
       if($check_username){
      
         if($check_username->password  == $password){
          $user_details = self::userDetails($check_username->id);
            $user_id = $user_details->user_id;
            $ip  = request()->ip();
            $client = new Client();
            $response = $client->get("http://ip-api.com/json/{$ip}");
            $locationData = json_decode($response->getBody(), true);
            $operation ='login';
            $createRecord = new LoginHistoryModel();
            $createRecord->user_id = $user_id;
            $createRecord->ip_address = $ip;
            $createRecord->country = $locationData['country'] ?? null;
            $createRecord->city = $locationData['city'] ?? null;
            $createRecord->region =$locationData['regionName'] ?? null;
            $createRecord->operation =$operation;
            $createRecord->image =$fileName;
            $createRecord->save();
        
            if($user_details->disable_account>0){
              return self::swal(false,'Account Disabled','warning');
            }

        session()->put('admin',$check_username->id);
        return self::swal(true,'Login Successfull','success');
         }else{
       return self::swal(false,'Invalid Password','error');
         }
       }else{
       return self::swal(false,'Invalid Username or Email','error');
       }
     }
     
       public function userDetails($id){
          $user_details = DB::table('main_user')
            ->join('permission','permission.user_id','main_user.id')
            ->join('roles','roles.role_name','=','main_user.user_type')
            ->where('main_user.id',$id)
            ->first();
            return $user_details;
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

//  THIS IS dashboardPage FUNCTIOIN 
public function dashboardPage(){
  $id = session('admin');
  
  $total_team_member=0;
  $import_lead=0;
  $total_invoices_data=0;
  $convert_to_clients=0;
  $total_clients=0;
  $email_send_cound = 0;
  $sms_count = 0;$operation_manager =0;
  $team_manager = 0;
  $customer_count =0;
  $assign_clients_count = 0;
  $none_assign_clients_count = 0;
  $team_member = 0;
  $service_data = '';
  $paid_customer_count = 0;
      $user_details = DB::table('main_user')
            ->join('permission','permission.user_id','main_user.id')
            ->join('roles','roles.role_name','=','main_user.user_type')
            ->where('main_user.id',$id)
            ->first();

            if($user_details->user_type=="admin"){
              $customer_count = CustomerModel::count();
              $assign_clients_count = CustomerModel::where('team_member','!=',null)->count();
              $none_assign_clients_count = CustomerModel::where('team_member','=',null)->count();
              $email_send_cound = EmailModel::count();
              $sms_count = MessageModel::count();
            
              $operation_manager = DB::table("main_user")->join("permission","permission.user_id","=","main_user.id")->where('main_user.user_type',"operation_manager")->count();
              $team_manager = DB::table("main_user")->join("permission","permission.user_id","=","main_user.id")->where('main_user.user_type',"team_manager")->count();
              $team_member = DB::table("main_user")->join("permission","permission.user_id","=","main_user.id")->where('main_user.user_type',"customer_success_manager")->count();
              $import_lead = CustomerModel::where('customer_service_id',14)->count();
              $service_data = Service::all();
              $paid_customer_count =DB::table('payments')->join('customer','customer.customer_id','=','payments.leads_id')->where('payments.pay_status',1)->count();
            }else if($user_details->user_type=="team_manager"){

              $team_manager_services = TeamManagersServicesModel::where('team_manager_id',$user_details->user_id)->distinct()->get(['managers_services_id']);
             
              $service_id = [];
      
              foreach($team_manager_services as $service){
                $service_id[] = $service->managers_services_id;
              }

              $team_member = DB::table("member_service")
              // ->select('member_service.member_id', DB::raw('MAX(main_user.first_name) as first_name')) 
              ->join('services','services.service_id','=','member_service.member_service_id')
              ->join("main_user", 'main_user.id', '=', 'member_service.member_id')
              ->whereIn('member_service.member_service_id', $service_id)
              // ->groupBy('member_service.member_service_id')
              ->count();
              // dd($team_member);

             $customer_count = CustomerModel::whereIn('customer_service_id',$service_id)->count();

             $none_assign_clients_count = CustomerModel::whereIn('customer_service_id',$service_id)->where("team_member",'=',null)->count();
             $assign_clients_count = CustomerModel::whereIn('customer_service_id',$service_id)->where("team_member",'!=',null)->count();
            
            } else if($user_details->user_type=="customer_success_manager" ){

              $customer_success_manager_services = MemberServiceModel::where('member_id', $user_details->user_id)
              ->distinct()
              ->get(['member_service_id']); 

                $service_id=[];
              if(!empty($customer_success_manager_services)){
                   foreach($customer_success_manager_services as $service){
                       $service_id[] = $service->member_service_id;
                    }
                  $customer_count= CustomerModel::whereIn('customer_service_id',$service_id)->count();
              }
                $email_send_cound = DB::table('main_user')
               ->join('email_send','email_send.email_admin','=','main_user.id')
               ->join('customer','customer.customer_id','=','email_send.email_customer')
               ->where('email_send.email_admin',$user_details->id)
               ->count();
                        
            }else if($user_details->user_type=="operation_manager"){
                $team_manager_services = TeamManagersServicesModel::where('team_manager_id',$user_details->user_id)->distinct()->get(['managers_services_id']);
             
                 $service_id = [];
      
                foreach($team_manager_services as $service){
                  $service_id[] = $service->managers_services_id;
                }


                $team_manager = DB::table("team_manager_services")
                ->join('services','services.service_id','=','team_manager_services.managers_services_id')
                ->join("main_user", 'main_user.id', '=', 'team_manager_services.team_manager_id')
                ->where('main_user.user_type',"team_manager")
                ->whereIn('team_manager_services.managers_services_id', $service_id)
                ->count();

                $team_member = DB::table("member_service")
                ->join('services','services.service_id','=','member_service.member_service_id')
                ->join("main_user", 'main_user.id', '=', 'member_service.member_id')
                ->whereIn('member_service.member_service_id', $service_id)
                ->count();

                $customer_count = CustomerModel::whereIn('customer_service_id',$service_id)->distinct('customer_email')->count(); 
                $assign_clients_count = CustomerModel::whereIn('customer_service_id',$service_id)->where("team_member",'!=',null)->distinct('customer_email')->count();
                $none_assign_clients_count = CustomerModel::whereIn('customer_service_id',$service_id)->where("team_member",'=',null)->distinct('customer_email')->count();
                $import_lead_team_manager_services = TeamManagersServicesModel::where('team_manager_id',$user_details->user_id)->where('managers_services_id',14)->distinct()->get(['managers_services_id']);
                 $s_id = [];
      
                foreach($import_lead_team_manager_services as $val){
                  $s_id[] = $val->managers_services_id;
                }
                $import_lead = CustomerModel::whereIn('customer_service_id',$s_id)->distinct('customer_email')->count();

            }

   $user_type = self::userType($user_details->user_type);
          
   return view('admin.dashboard.index',['admin_data'=>$user_details,'total_customer'=>$customer_count,'assign_customer'=>$assign_clients_count,'none_assign_customer'=>$none_assign_clients_count,'total_email'=>$email_send_cound,'sms_count'=>$sms_count,'user_type'=>$user_type,'operation_manager'=>$operation_manager,'team_manager'=>$team_manager,'team_member'=>$team_member,'import_lead'=>$import_lead,'service_data'=>$service_data,'paid_customer_count'=>$paid_customer_count]);
}
//  THIS IS dashboardPage FUNCTIOIN 

// THIS IS A chnagePasswordPage FUNCITON 
public function chnagePasswordPage(){
   $id = session('admin');
  // $admin_data = AdminModel::find($id);
   $admin_data = self::userDetails($id);
   $user_type = self::userType($admin_data->user_type);
  return view('admin.dashboard.change_password',['admin_data'=>$admin_data,'user_type'=>$user_type]);
  
}
// THIS IS A chnagePasswordPage FUNCITON 
// THIS IS A logout FUNCTION 


// THIS IS A logout FUNCTION 
public function logout(){
    $id = session('admin');
    $user_details = self::userDetails($id);
    $user_id = $user_details->id;
    $ip  = request()->ip();
    $client = new Client();
    $response = $client->get("http://ip-api.com/json/{$ip}");
    $locationData = json_decode($response->getBody(), true);
    $operation ='logout';
    LoginHistoryModel::create([
      'user_id'=>$user_id,
      'ip_address' => $ip,
      'country' => $locationData['country'] ?? null,
      'city' => $locationData['city'] ?? null,
      'region' => $locationData['regionName'] ?? null,
      'operation'=>$operation,
    ]);
  session()->forget('admin');
  return redirect('/login');
}
// THIS IS A logout FUNCTION 

// THIS IS changePassword FUNCTION 
public function changePassword(Request $request){
  $old = $request->old;
  $new = $request->new;
  $confirm = $request->confirm;
  $check_old_password = MainUserModel::find(session('admin'));
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
  $check_email = AdminModel::where('email',$email)->first();
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
    $db_otp = AdminModel::find($id);
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
   $admin_data = AdminModel::find(session('admin_forgot_id'));
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
    $id = session('admin');
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    $services =  Service::orderBy('service_id','DESC')->where('name','!=','Uncategorized')->get();
    $roles = Role::where('role_name','!=','admin')->orderBy('id','DESC')->get();
    return view('admin.dashboard.add_contact',['admin_data'=>$admin_data,'user_type'=>$user_type,'services'=>$services,'roles'=>$roles]);
    
}
// THIS IS addContactPage FUNCTION  

// THIS IS  changeUsername FUNCTION 
public function changeUsernamePage(){
    $id = session('admin');
   //$admin_data = AdminModel::find($id);
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    return view('admin.dashboard.change_username',['admin_data'=>$admin_data,'user_type'=>$user_type]);
}
// THIS IS  changeUsername FUNCTION 
// THIS IS changeUsername FUNCTION \

public function changeUsername(Request $request){
  $email = $request->new_email; 
  $first_name = $request->new_first_name;
  $last_name = $request->new_last_name;
  $account_name = $request->new_account_name;
  $update_data = MainUserModel::find(session('admin'));
  if($email!=""){
   $update_data->email_address= $email;
  }
  if($first_name!=""){
   $update_data->first_name= $first_name;
  }
  if($last_name!=""){
   $update_data->last_name= $last_name;
  }
  if($account_name!=""){
   $update_data->account_name= $account_name;
  }

 if($first_name==""&& $last_name==""&&$email==""&&$account_name==""){
   return self::toastr(false,"Sorry..Noting For Update","error","Error");
 }else{
  $update_data->save();
   return self::toastr(true,"Details Updated Successfull","success","Success");

 }

}
// THIS IS changeUsername FUNCTION 

// THIS IS addServicePage FUNCTION  
public function addServicePage(){
  $id = session('admin');
  //$admin_data = AdminModel::find($id);
  $admin_data = self::userDetails($id);
  $user_type = self::userType($admin_data->user_type);

  return view('admin.dashboard.add_service',['admin_data'=>$admin_data,'user_type'=>$user_type]);
}
// THIS IS addServicePage FUNCTION  
// THIS IS addTeamMember FUNCTION  
public function addTeamMember(){
    $id = session('admin');
    $admin_data = AdminModel::find($id);
    $services = Service::orderBy('service_id','DESC')->get();
    return view('admin.dashboard.add_team_member',['admin_data'=>$admin_data,'services_data'=>$services]);
}
// THIS IS addTeamMember FUNCTION  
// THIS IS addPackagePage FUNCTION  
public function addPackagePage(){
  $id = session('admin');
  $admin_data = self::userDetails($id);
  $user_type = self::userType($admin_data->user_type);
  $services =Service::orderBy('service_id','DESC')->get();
  return view('admin.dashboard.add_package',['admin_data'=>$admin_data,'user_type'=>$user_type,'services'=>$services]);
}
// THIS IS addPackagePage FUNCTION  
public function allPackages(){
    $id = session('admin');
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    $all_packages = DB::table('packages')
      ->select('packages.package_id','packages.title','packages.price','services.name as service_name','subservices.service_name as subservice_name')
      ->join('services','services.service_id','=','packages.service_id')
      ->leftjoin('subservices','subservices.id','=','packages.subservice_id')
      ->whereNull('packages.deleted_at')
      ->orderBy('packages.package_id','DESC')
      ->paginate(10);
     
   // $all_packages = Package::orderBy('package_id','DESC')->paginate(10);
    /*if($admin_data->user_type == "operation_manager" || $admin_data->user_type == "team_manager"){
      $team_manager_services=TeamManagersServicesModel::where('team_manager_id',$admin_data->user_id)->get();
            
            if(!empty($team_manager_services)){
                    $service_id = [];
                    foreach($team_manager_services as $service){
                      $service_id[] = $service->managers_services_id;
                    }
                    $all_packages = DB::table('packages')
                    ->select('packages.package_id','packages.title','packages.price','services.name as service_name','subservices.service_name as subservice_name')
                    ->join('services','services.service_id','=','packages.service_id')
                    ->leftjoin('subservices','subservices.id','=','packages.subservice_id')
                    ->whereIn('packages.service_id',$service_id)
                    ->orderBy('packages.package_id','DESC')
                    ->paginate(10);
                   
            }
     

    }else if($admin_data->user_type == "customer_success_manager"){
      $customer_success_manager_services = MemberServiceModel::where('member_id', $admin_data->user_id)
              ->distinct()
              ->get(['member_service_id']); 

                $service_id=[];
              if(!empty($customer_success_manager_services)){
                   foreach($customer_success_manager_services as $service){
                       $service_id[] = $service->member_service_id;
                    }
                   $all_packages = DB::table('packages')
                    ->select('packages.package_id','packages.title','packages.price','services.name as service_name','subservices.service_name as subservice_name')
                    ->join('services','services.service_id','=','packages.service_id')
                    ->leftjoin('subservices','subservices.id','=','packages.subservice_id')
                    ->whereIn('packages.service_id',$service_id)
                    ->orderBy('packages.package_id','DESC')
                    ->paginate(10);
                   
            }
     

    }else if($admin_data->user_type == "admin"){
       $all_packages = DB::table('packages')
      ->select('packages.package_id','packages.title','packages.price','services.name as service_name','subservices.service_name as subservice_name')
      ->join('services','services.service_id','=','packages.service_id')
      ->leftjoin('subservices','subservices.id','=','packages.subservice_id')
      ->orderBy('packages.package_id','DESC')
      ->paginate(10);
     
    }*/
    return view('admin.dashboard.all_packages',['admin_data'=>$admin_data,'data'=>$all_packages,'user_type'=>$user_type]);
}

// loginHistory
public function loginHistory(Request $request ){
    $staffId = $request->id;
  
    $id = session('admin');
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);

    $role_services = RoleService::where('member_id',$admin_data->user_id)->distinct()->get(['service_id']);
        $service_id = [];

      foreach($role_services as $service){
        $service_id[] = $service->service_id;
      }
        $data = DB::table("role_services")   
            ->select('role_services.member_id','main_user.first_name as first_name','main_user.id as id','main_user.user_type as user_type','main_user.last_name as last_name','main_user.phone_number as phone_number','main_user.email_address as email_address','services.name as name','roles.modern_name as modern_name','login_history.operation as operation','login_history.ip_address as ip_address','login_history.image as image','login_history.city as city','login_history.country as country','login_history.logged_in_at as logged_in_at') 
            ->join("main_user", 'main_user.id', '=', 'role_services.member_id')
            ->join('roles','roles.role_name','=','main_user.user_type')
            ->join('login_history','login_history.user_id','=','main_user.id')
            ->join('services','services.service_id','=','role_services.service_id')
            ->whereIn('role_services.service_id', $service_id)
            ->paginate(10);

   /* if($admin_data->user_type == "admin"){

      if($staffId!=""){
          $data =   DB::table('main_user')->join('login_history','login_history.user_id','=','main_user.id')->join('roles','roles.role_name','=','main_user.user_type')->where('main_user.id',$staffId)->paginate(10);
        }else{
           $data = DB::table('main_user')->join('login_history','login_history.user_id','=','main_user.id')->join('roles','roles.role_name','=','main_user.user_type')->paginate(10);
       }
    }else if($admin_data->user_type == "team_manager"){
       $team_manager_services=TeamManagersServicesModel::where('team_manager_id',$admin_data->user_id)->get();
            
            $team_member=[];
            if(!empty($team_manager_services)){
                   $service_id = [];
                foreach($team_manager_services as $service){
                    $service_id[] = $service->managers_services_id;
                }

        $member_contact_data = DB::table("member_service")   
            ->select('member_service.member_id','main_user.first_name as first_name','main_user.id as id','main_user.user_type as user_type','main_user.last_name as last_name','main_user.phone_number as phone_number','main_user.email_address as email_address','services.name as name','roles.modern_name as modern_name','login_history.operation as operation','login_history.ip_address as ip_address','login_history.image as image','login_history.city as city','login_history.country as country','login_history.logged_in_at as logged_in_at') 
            ->join("main_user", 'main_user.id', '=', 'member_service.member_id')
            ->join('roles','roles.role_name','=','main_user.user_type')
            ->join('login_history','login_history.user_id','=','main_user.id')
            ->join('services','services.service_id','=','member_service.member_service_id')
            ->whereIn('member_service.member_service_id', $service_id)
            ->get();
        $manager_contact_data = DB::table("team_manager_services")   
            ->select('team_manager_services.team_manager_id','main_user.first_name as first_name','main_user.id as id','main_user.user_type as user_type','main_user.last_name as last_name','main_user.phone_number as phone_number','main_user.email_address as email_address','services.name as name','roles.modern_name as modern_name','login_history.operation as operation','login_history.ip_address as ip_address','login_history.image as image','login_history.city as city','login_history.country as country','login_history.logged_in_at as logged_in_at') 
            ->join("main_user", 'main_user.id', '=', 'team_manager_services.team_manager_id')
            ->join('roles','roles.role_name','=','main_user.user_type')
            ->join('login_history','login_history.user_id','=','main_user.id')
            ->join('services','services.service_id','=','team_manager_services.managers_services_id')
            ->where('main_user.user_type',"team_manager")
            ->whereIn('team_manager_services.managers_services_id', $service_id)
            ->get();
          $contact_data = $member_contact_data->merge($manager_contact_data);
          // Merge the member and manager contact data
          $merged_contact_data = $member_contact_data->merge($manager_contact_data);

          // Get the current page from the request, default to 1 if not set
          $currentPage = Paginator::resolveCurrentPage();

          // Define how many items per page
          $perPage = 10;

          // Slice the collection to get the items for the current page
          $currentItems = $merged_contact_data->slice(($currentPage - 1) * $perPage, $perPage)->values();

          // Create a LengthAwarePaginator instance
          $data = new LengthAwarePaginator(
              $currentItems,
              $merged_contact_data->count(),
              $perPage,
              $currentPage,
              ['path' => Paginator::resolveCurrentPath()]
          );
       }
    }else if($admin_data->user_type == "operation_manager"){
       $team_manager_services=TeamManagersServicesModel::where('team_manager_id',$admin_data->user_id)->get();
            
            $team_member=[];
            if(!empty($team_manager_services)){
                   $service_id = [];
                foreach($team_manager_services as $service){
                    $service_id[] = $service->managers_services_id;
                }

        $member_contact_data = DB::table("member_service")   
            ->select('member_service.member_id','main_user.first_name as first_name','main_user.id as id','main_user.user_type as user_type','main_user.last_name as last_name','main_user.phone_number as phone_number','main_user.email_address as email_address','services.name as name','roles.modern_name as modern_name','login_history.operation as operation','login_history.ip_address as ip_address','login_history.image as image','login_history.city as city','login_history.country as country','login_history.logged_in_at as logged_in_at') 
            ->join("main_user", 'main_user.id', '=', 'member_service.member_id')
            ->join('roles','roles.role_name','=','main_user.user_type')
            ->join('login_history','login_history.user_id','=','main_user.id')
            ->join('services','services.service_id','=','member_service.member_service_id')
            ->whereIn('member_service.member_service_id', $service_id)
            ->get();
        $manager_contact_data = DB::table("team_manager_services")   
            ->select('team_manager_services.team_manager_id','main_user.first_name as first_name','main_user.id as id','main_user.user_type as user_type','main_user.last_name as last_name','main_user.phone_number as phone_number','main_user.email_address as email_address','services.name as name','roles.modern_name as modern_name','login_history.operation as operation','login_history.ip_address as ip_address','login_history.image as image','login_history.city as city','login_history.country as country','login_history.logged_in_at as logged_in_at') 
            ->join("main_user", 'main_user.id', '=', 'team_manager_services.team_manager_id')
            ->join('roles','roles.role_name','=','main_user.user_type')
            ->join('login_history','login_history.user_id','=','main_user.id')
            ->join('services','services.service_id','=','team_manager_services.managers_services_id')
            ->where('main_user.user_type',"operation_manager")
            ->whereIn('team_manager_services.managers_services_id',$service_id)
            ->get();

          $contact_data = $member_contact_data->merge($manager_contact_data);
          // Merge the member and manager contact data
          $merged_contact_data = $member_contact_data->merge($manager_contact_data);

          // Get the current page from the request, default to 1 if not set
          $currentPage = Paginator::resolveCurrentPage();

          // Define how many items per page
          $perPage = 10;

          // Slice the collection to get the items for the current page
          $currentItems = $merged_contact_data->slice(($currentPage - 1) * $perPage, $perPage)->values();

          // Create a LengthAwarePaginator instance
          $data = new LengthAwarePaginator(
              $currentItems,
              $merged_contact_data->count(),
              $perPage,
              $currentPage,
              ['path' => Paginator::resolveCurrentPath()]
          );
       }
    }*/
   return view('admin.dashboard.login_history',['admin_data'=>$admin_data,'data'=>$data,'user_type'=>$user_type]);
   

}

public function editPackage($package_id){
    $id = session('admin');
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    $services =Service::orderBy('service_id','DESC')->get();
    $p_id =   Crypt::decrypt($package_id);
    $data = Package::find($p_id);
    $services_data = Service::find($data->service_id);
    $subservices_data = Subservice::where('service_id',$data->service_id)->get();

    $sub_service_data =Subservice::find($data->subservice_id);
   return view('admin.dashboard.edit_package',['admin_data'=>$admin_data,'data'=>$data,'user_type'=>$user_type,'services_data'=>$services_data,'services'=>$services,'sub_service_data'=>$sub_service_data,'subservices_data'=>$subservices_data]);
   
  }
public function addRolePage(){
  $id = session('admin');
  $admin_data = self::userDetails($id);
  $user_type = self::userType($admin_data->user_type);
  return view('admin.dashboard.add_role',['admin_data'=>$admin_data,'user_type'=>$user_type]);
}

// THIS IS END OF CLASS 
 
}