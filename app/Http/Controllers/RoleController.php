<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\AdminModel;
use App\Models\TeamMember; 
use App\Models\Invoice;
use App\Models\CustomerModel;
use App\Models\MemberServiceModel;
use App\Models\TeamManagersServicesModel;
use App\Models\Service;
use App\Models\MainUserModel;

use DB;
use Crypt;

class RoleController extends Controller
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
    public function RoleAdd(Request $request){

      $name = strtolower(trim($request->name));
      $service = $request->service;
      $user_type = $request->user_type;
     if(Role::where('role_name',$name)->first()){
         return self::toastr(false,"Role Name Already Exist","error","Error");
     }
     foreach ($service as $key => $value) {
       $role_details = new Role;
       $role_details->main_service_id=$value;
       $role_details->role_name=$name;
       $role_details->modern_name=$name;
       $role_details->save();
     }
      
          
       return self::toastr(true," Add Successfully","success","Success");
    }

    
     public function allRoles(){
	    $id = session('admin');
	    $admin_data = self::userDetails($id);
	    $user_type = self::userType($admin_data->user_type);
	    // $roles = Role::where('role_name','!=','admin')->orderBy('id','DESC')->paginate(10);   
	    $roles = DB::table("roles")
      ->join("services","services.service_id",'=',"roles.main_service_id")
      ->where('roles.role_name','!=','admin')
      ->orderBy('roles.id','DESC')
      ->paginate(10);   
	    return view('admin.dashboard.allroles',['admin_data'=>$admin_data,'data'=>$roles,'user_type'=>$user_type]);
     }


      public function editRole($role_id){
	    $id = session('admin');
	    $admin_data = self::userDetails($id);
	    $user_type = self::userType($admin_data->user_type);
	    $r_id =   Crypt::decrypt($role_id);
	    $service = Service::orderBy('service_id','DESC')->get();
      
      $data  = DB::table("roles")
      ->join("services",'services.service_id','=','roles.main_service_id')
      ->where('roles.id',$r_id)
      ->first();

	   return view('admin.dashboard.edit_role',['admin_data'=>$admin_data,'data'=>$data,'user_type'=>$user_type,'service'=>$service]);
	   
	  }
	  public function updateRole(Request $request){
	      $name = strtolower(trim($request->name));
	      $role_id = $request->role_id;
        $service = $request->service;
	      if(Role::where('role_name',$name)->whereIn('main_service_id',$request->service)->first()){
            return self::toastr(false,"Role Name Already Exist","error","Error");
          }
	      $role_details = Role::find($role_id)->delete();
        
        foreach ($service as $key => $value) {
        $role_details = new Role();
        $role_details->role_name=$name;
        $role_details->main_service_id=$value;
        $role_details->modern_name = $name;
        $role_details->save();
        }
        return self::toastr(true,"Updated Successfull","success","Success");
      } 

      
      public function role_delete(Request $request){
	    $id = $request->id;
	    $delete = Role::find($id)->delete();
	    if($delete){
	       return self::toastr(true,'Deleted Successfull','success','Success');
	    }else{
	      return self::toastr(false,'Technical Issue','error','Error');
	        
	    }
    }

    public function viewServiceBaseRole($service_id){
     	    $id = session('admin');
	    $admin_data = self::userDetails($id);

          $roles = DB::table("roles")
      ->join("services","services.service_id",'=',"roles.main_service_id")
      ->where("services.service_id",$service_id)
      ->orderBy('roles.id','DESC')
      ->paginate(10);   
	    return view('admin.dashboard.allroles',['admin_data'=>$admin_data,'data'=>$roles]);


      
    }
   
}