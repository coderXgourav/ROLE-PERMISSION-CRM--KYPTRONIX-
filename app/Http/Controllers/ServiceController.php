<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\AdminModel;
use App\Models\TeamMember; 
use App\Models\Invoice;
use App\Models\CustomerModel;
use App\Models\MemberServiceModel;
use App\Models\TeamManagersServicesModel;
use App\Models\MainUserModel;
use App\Models\Subservice;
use DB;
use Crypt;

class ServiceController extends Controller
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

   
    // THIS IS serviceAdd FUNCTION 
    public function serviceAdd(Request $request){

      $name = strtolower(trim($request->name));
      $sub_service_name =$request->subcategory;
      $user_type = $request->user_type;
     if(Service::where('name',$name)->first()){
         return self::toastr(false,"Service Already Exist","error","Error");
     }
     if(!empty($sub_service_name)){

            $service_details = new Service;
            $service_details->name = $name;
            $service_details->user_type = $user_type;
            $service_details->save();
            $service_id =$service_details->service_id;
            // print_r($service_id);die;
            foreach ($sub_service_name as $key => $value) {
              $sub_service_details = new Subservice;
              if($value!=""){
              $sub_service_details->service_id = $service_id;
              $sub_service_details->service_name = $value;
              $sub_service_details->save();
              }
            
            }

       return self::toastr(true,"Service Add Successfull","success","Success");
    }else{
      
    }

      
    }
    // THIS IS serviceAdd FUNCTION 
    //AllService Start
    public function allServices(){
	  $id = session('admin');
	  // $admin_data = AdminModel::find($id);
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    $services = Service::orderBy('service_id','DESC')->where('name','!=','Uncategorized')->paginate(10);   
	  return view('admin.dashboard.allservices',['admin_data'=>$admin_data,'data'=>$services,'user_type'=>$user_type]);
  }
  //AllService End
  //ServiceDelete Start
  public function service_delete(Request $request){
    $id = $request->id;
    $delete = Service::find($id)->delete();
    if($delete){
       return self::toastr(true,'Deleted Successfull','success','Success');
    }else{
      return self::toastr(false,'Technical Issue','error','Error');
        
    }
  }
  //ServiceDelete End
  //editService Start
  public function editService($service_id){
    $id = session('admin');
    //$admin_data = AdminModel::find($id);
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    $s_id =   Crypt::decrypt($service_id);
    $data = Service::find($s_id);
    $sub_service_details =Subservice::where('service_id',$s_id)->get();
   return view('admin.dashboard.edit_service',['admin_data'=>$admin_data,'data'=>$data,'user_type'=>$user_type,'sub_service_details'=>$sub_service_details]);
   
  }
  //editService End
  //updateService Start
  public function updateService(Request $request){
      $name = strtolower(trim($request->name));
      $service_id = $request->service_id;
      $sub_service_id = $request->sub_service_id;
      $sub_service_name = $request->subcategory;
      $add_sub_service =$request->sub_service;
        

      if(!empty($sub_service_id)){

          $service_details = Service::find($service_id);
          $service_details->name = $name;
          $service_details->save();

          for($i=0; $i<count($sub_service_id); $i++){
                  $sub_service_details = Subservice::find($sub_service_id[$i]);
                 $sub_service_details->service_name = $sub_service_name[$i];
                 $sub_service_details->save();            
          }

      }if(!empty($add_sub_service)){
           foreach ($add_sub_service as $key => $value) {
              $s_details = new Subservice;
              if($value!=""){
              $s_details->service_id = $service_id;
              $s_details->service_name = $value;
              $s_details->save();
              }
            
           }
      }
      return self::toastr(true,"Service Details Updated Successfull","success","Success");

  } 
  //updateService End
  //viewService Start
  public function viewService($service_id){
    $id = session('admin');
   // $admin_data = AdminModel::find($id);
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    $s_id =   Crypt::decrypt($service_id);
    $data = Service::find($s_id);

    $team_member=DB::table('main_user')
    ->join("permission",'permission.user_id','=','main_user.id')
    ->join('member_service','member_service.member_id','=','main_user.id')
    ->where('member_service.member_service_id','=',$s_id)
    ->distinct()
    ->get(['member_service.member_id'])
    ->count();

    $leads=CustomerModel::where('customer_service_id',$s_id)->count();
    $invoice =Invoice::where('service_id',$s_id)->count();

    $team_manager_service = DB::table('main_user')
    ->join("permission",'permission.user_id','=','main_user.id')
    ->join('team_manager_services','team_manager_services.team_manager_id','=','main_user.id')
    ->where('team_manager_services.managers_services_id','=',$s_id)
    ->count();
    $total_sub_service = Subservice::where('service_id',$s_id)->count();
   return view('admin.dashboard.view_service',['admin_data'=>$admin_data,'data'=>$data,'total_team_member'=>$team_member,'total_leads'=>$leads,'total_invoices'=>$invoice,'user_type'=>$user_type,'team_manager'=>$team_manager_service,'total_sub_service'=>$total_sub_service]);
   
  }


  //viewService End
  //teamMember Start
 public function teamMember($service_id){
     $id = session('admin');
     $admin_data = self::userDetails($id);
     $user_type = self::userType($admin_data->user_type);
     $team_member = DB::table('main_user')
    ->select('main_user.*', 'services.name as service_name')
    ->join('member_service','member_service.member_id','=','main_user.id')
    ->join('services', 'services.service_id', '=', 'member_service.member_service_id')
    ->where('member_service.member_service_id',$service_id)
    ->distinct(['member_service.member_service_id'])
    ->get();
    return view('admin.dashboard.service_team_members',['admin_data'=>$admin_data,'team_member'=>$team_member,'user_type'=>$user_type]);
}
//teamMember End
//showLeadsList Start
public function showLeadsList($service_id){
    $id = session('admin');
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    $clients = DB::table('customer')
    ->join('services','services.service_id','=','customer.customer_service_id')
    ->select('customer.*','services.name as service_name')
    ->where('customer.customer_service_id',$service_id)
    ->paginate(10);
   return view('admin.dashboard.show_leads_lists',['admin_data'=>$admin_data,'clients'=>$clients,'user_type'=>$user_type]);
}
//showLeadsList End
//serviceInvoices Start
public function serviceInvoices($service_id){
    $id = session('admin');
    $admin_data = self::userDetails($id);
    $user_type = self::userType($admin_data->user_type);
    $invoice = DB::table('invoices')
     ->select('customer.customer_name','customer.customer_number','invoices.created_at','invoices.invoice_id','customer.customer_id','invoices.service_id','invoices.price')
     ->join('customer','customer.customer_id','=','invoices.customer_id')
     ->where('invoices.service_id',$service_id)
     ->paginate(10);
   return view('admin.dashboard.service_invoices',['admin_data'=>$admin_data,'data'=>$invoice,'user_type'=>$user_type]);
}
//serviceInvoices End

public function teamManagerList($service_id){
  
     $id = session('admin');
     $admin_data = self::userDetails($id);
     $user_type = self::userType($admin_data->user_type);
     $team_manager_data =DB::table('main_user')
     ->select('main_user.first_name','main_user.last_name','main_user.id','main_user.user_type','main_user.email_address','main_user.phone_number')
     ->join('team_manager_services','team_manager_services.team_manager_id','=','main_user.id')
     ->where('team_manager_services.managers_services_id','=',$service_id)
     ->paginate(10);
    /* $team_manager = DB::table('team_manager_services')  
    ->whereJsonContains('managers_services_id', $service_id) // Assumes it's a JSON array
    ->get();


    $team_manager_data = collect(); // Create an empty collection to store all users

    for ($i=0; $i < count($team_manager); $i++) { 
        $users = MainUserModel::where('id',  $team_manager[$i]->team_manager_id)->get(['first_name','last_name','id','user_type','email_address','phone_number']);
    $team_manager_data = $team_manager_data->merge($users);
    }*/
    return view('admin.dashboard.service_team_managers',['admin_data'=>$admin_data,'team_manager'=>$team_manager_data,'user_type'=>$user_type]);
}
public function deleteSubService(Request $request){  
    $id = $request->id;
    $delete = Subservice::find($id)->delete();
    if($delete){
       return self::toastr(true,'Deleted Successfully','success','Success');
    }else{
      return self::toastr(false,'Technical Issue','error','Error');
        
    }
  }
public function subServiceList($service_id){
  
     $id = session('admin');
     $admin_data = self::userDetails($id);
     $user_type = self::userType($admin_data->user_type);
     $data =DB::table('subservices')
     ->select('subservices.service_name','subservices.id','subservices.service_id')
     ->where('subservices.service_id','=',$service_id)
     ->paginate(10);
    return view('admin.dashboard.sub_service_list',['admin_data'=>$admin_data,'sub_service'=>$data,'user_type'=>$user_type]);
}


}