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
use App\Models\Package;
use App\Models\RoleService;
use App\Models\Role;
use App\Models\CustomerServiceModel;
use App\Models\CustomerPackageModel;
use App\Models\Sub_Subservice;
use App\Models\CustomerSubServiceModel;


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

      


    // public function userType(){
    //     $user_type = self::userDetails();
    //     echo "<pre>";
    //     print_r($user_type);
    //     die;
     
    // }

   
    // THIS IS serviceAdd FUNCTION 

public function serviceAdd(Request $request)
{
    // Retrieve Main Service Data
    $mainServiceName = trim($request['main_service']['name']);
    $packages = $request['main_service']['packages'] ?? [];

    // Check for Existing Main Service
    
    if (Service::where('name', $mainServiceName)->exists()) {
        return self::toastr(false, "This Main Service Already Exists", "error", "Error");
    }

    // Save Main Service
    $service_details = new Service;
    $service_details->name = $mainServiceName;
    $service_details->save();
    $service_id = $service_details->service_id;

    if (!empty($packages)) {
    $formattedPackages = [];
    $temp = []; 
    foreach ($packages as $package) {
        $temp = array_merge($temp, $package); 
        if (count($temp) === 4) {
            $formattedPackages[] = $temp; 
            $temp = []; 
        }
    }
}

    if (!empty($formattedPackages)) {
        foreach ($formattedPackages as $package) {
            $this->savePackage($service_id, $package, 'main');
        }
        
    }
  

    // Process Services and Sub-Services
    $services = $request['main_service']['services'] ?? [];
    foreach ($services as $service) {
        // Save Service
        $serviceName = $service['name'];
        $sub_service_details = new Subservice;
        $sub_service_details->service_id = $service_id;
        $sub_service_details->service_name = $serviceName;
        $sub_service_details->save();
        $sub_service_id = $sub_service_details->id;

        // Save Packages for Service
        // if (isset($service['packages'])) {
        //     foreach ($service['packages'] as $package) {
        //         $this->savePackage($sub_service_id, $package, 'service');
        //     }
        // }
        

        if (!empty($service['packages'])) {
            $formattedPackages = [];
            $temp = []; 
            foreach ($service['packages'] as $package) {
                $temp = array_merge($temp, $package); 
                if (count($temp) === 4) {
                    $formattedPackages[] = $temp; 
                    $temp = []; 
                }
            }
        }

        if (!empty($formattedPackages)) {
            foreach ($formattedPackages as $package) {
                $this->savePackage($sub_service_id, $package, 'service');
            }
        }

        // Process Sub-Services
        $sub_services = $service['sub_services'] ?? [];
        foreach ($sub_services as $sub_service) {
            $subServiceName = $sub_service['name'];
            $sub_sub_service_details = new Sub_Subservice;
            $sub_sub_service_details->sub_service_main_id = $sub_service_id;
            $sub_sub_service_details->sub_subservice_name = $subServiceName;
            $sub_sub_service_details->save();
            $sub_sub_service_id = $sub_sub_service_details->sub_subservice_id;
           
            // if (isset($sub_service['packages'])) {
            //     foreach ($sub_service['packages'] as $package) {
            //         $this->savePackage($sub_sub_service_id, $package, 'sub_service');
            //     }
            // }

            
        if (!empty($sub_service['packages'])) {
            $formattedPackages = [];
            $temp = []; 
            foreach ($sub_service['packages'] as $package) {
                $temp = array_merge($temp, $package); 
                if (count($temp) === 4) {
                    $formattedPackages[] = $temp; 
                    $temp = []; 
                }
            }
        }

        if (!empty($formattedPackages)) {
            foreach ($formattedPackages as $package) {
                $this->savePackage($sub_sub_service_id, $package, 'sub_service');
            }
        }
     }
    }

    return self::toastr(true, "Service Added Successfully", "success", "Success");
}




private function savePackage($id, $package, $type)
{
//    echo "<pre>";
//    print_r($package);
//    die;
    if (!isset($package['package_name'],$package['trial'], $package['price'], $package['package_duration'])) {
        return; 
    }

    $packageModel = new Package;
    if ($type === "main") {
        $packageModel->service_id = $id;
    } elseif ($type === "service") {
        $packageModel->subservice_id = $id;
    } elseif ($type === "sub_service") {
        $packageModel->sub_subservice_id = $id;
    }
    $packageModel->title = $package['package_name'];
    $packageModel->price = $package['price'];
    $packageModel->duration = $package['package_duration'];
    $packageModel->free_trial = $package['trial'];

    $packageModel->save();
}


    // THIS IS serviceAdd FUNCTION 
    //AllService Start
    
    public function allServices(){
	  $id = session('admin');
    $admin_data = self::userDetails($id);
        $services = Service::orderBy('service_id','DESC')->paginate(10);   
	  return view('admin.dashboard.allservices',['admin_data'=>$admin_data,'data'=>$services]);
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
    $s_id =   Crypt::decrypt($service_id);
    $data = Service::find($s_id);
    $sub_service_details =Subservice::where('service_id',$s_id)->get();
   return view('admin.dashboard.edit_service',['admin_data'=>$admin_data,'data'=>$data,'sub_service_details'=>$sub_service_details]);
   
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
    $admin_data = self::userDetails($id);
    $s_id = Crypt::decrypt($service_id);
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
    $roles = Role::where('main_service_id',$s_id)->count();

    $team_manager_service = DB::table('main_user')
    ->join("permission",'permission.user_id','=','main_user.id')
    ->join('team_manager_services','team_manager_services.team_manager_id','=','main_user.id')
    ->where('team_manager_services.managers_services_id','=',$s_id)
    ->where('main_user.user_type','team_manager')
    ->count();
    
    
     $operation_manager_count =DB::table('main_user')
     ->join('team_manager_services','team_manager_services.team_manager_id','=','main_user.id')
     ->where('team_manager_services.managers_services_id','=',$s_id)
     ->where('main_user.user_type','=',"operation_manager")
     ->count();

    
    $total_sub_service = Subservice::where('service_id',$s_id)->count();
    
   return view('admin.dashboard.view_service',['admin_data'=>$admin_data,'data'=>$data,'total_team_member'=>$team_member,'total_leads'=>$leads,'total_invoices'=>$invoice,'team_manager'=>$team_manager_service,'total_sub_service'=>$total_sub_service,'operation_manager_count'=>$operation_manager_count,'roles'=>$roles]);
   
  }

   public function getRoles(Request $request)
    {
        $request->validate([
            'service_ids' => 'required|array',
        ]);

        $serviceIds = $request->input('service_ids');
           if(count($serviceIds)>1){
           $roles = DB::table("roles")
            ->whereIn("roles.main_service_id", $serviceIds)
            ->get();



           }else{
            $roles = DB::table("roles")
            ->whereIn("roles.main_service_id", $serviceIds)
            ->get();
           }


        return response()->json($roles);
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
    $clients = DB::table('customer')
    ->join('services','services.service_id','=','customer.customer_service_id')
    ->select('customer.*','services.name as service_name')
    ->where('customer.customer_service_id',$service_id)
    ->paginate(10);
   return view('admin.dashboard.show_leads_lists',['admin_data'=>$admin_data,'clients'=>$clients]);
}
//showLeadsList End
//serviceInvoices Start
public function serviceInvoices($service_id){
    $id = session('admin');
    $admin_data = self::userDetails($id);
    $invoice = DB::table('invoices')
     ->select('customer.customer_name','customer.customer_number','invoices.created_at','invoices.invoice_id','customer.customer_id','invoices.service_id','invoices.price')
     ->join('customer','customer.customer_id','=','invoices.customer_id')
     ->where('invoices.service_id',$service_id)
     ->paginate(10);
   return view('admin.dashboard.service_invoices',['admin_data'=>$admin_data,'data'=>$invoice]);
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
     ->where('main_user.user_type','team_manager')
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



public function operationManagerList($service_id){
  
     $id = session('admin');
     $admin_data = self::userDetails($id);
     $user_type = self::userType($admin_data->user_type);

     $operation_manager_data =DB::table('main_user')
     ->select('main_user.first_name','main_user.last_name','main_user.id','main_user.user_type','main_user.email_address','main_user.phone_number')
     ->join('team_manager_services','team_manager_services.team_manager_id','=','main_user.id')
     ->where('team_manager_services.managers_services_id','=',$service_id)
     ->where('main_user.user_type','operation_manager')
     ->paginate(10);

     
    /* $team_manager = DB::table('team_manager_services')  
    ->whereJsonContains('managers_services_id', $service_id) // Assumes it's a JSON array
    ->get();


    $team_manager_data = collect(); // Create an empty collection to store all users

    for ($i=0; $i < count($team_manager); $i++) { 
        $users = MainUserModel::where('id',  $team_manager[$i]->team_manager_id)->get(['first_name','last_name','id','user_type','email_address','phone_number']);
    $team_manager_data = $team_manager_data->merge($users);
    }*/
    return view('admin.dashboard.service_team_managers',['admin_data'=>$admin_data,'team_manager'=>$operation_manager_data,'user_type'=>$user_type]);
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
     $data =DB::table('subservices')
     ->select('subservices.service_name','subservices.id','subservices.service_id')
     ->where('subservices.service_id','=',$service_id)
     ->paginate(10);
    return view('admin.dashboard.sub_service_list',['admin_data'=>$admin_data,'sub_service'=>$data]);
}

    public function getSubservicesByServiceId($serviceIds)
    {
        $sIds = explode(',', $serviceIds);
        $subservices = Subservice::whereIn('service_id', $sIds)->get();
        return response()->json($subservices);
    }
     public function getSubservices($serviceIds)
    {
        $sIds = explode(',', $serviceIds);
        $subservices = Subservice::whereIn('service_id', $sIds)->get();
        return response()->json($subservices);
    }
    public function filterServices(Request $request)
    {
        $id = session('admin');
        $admin_data = self::userDetails($id);
        $service_details = Service::orderBy('service_id','DESC')->get();

        $lead_name=$request->lead_name;
        if($admin_data->user_type == 'admin'){
          // Base query
          $query = DB::table('customer')
              ->select(
                  'customer.customer_email',
                  DB::raw('MAX(customer.customer_id) as customer_id'),
                  DB::raw('MAX(customer.customer_number) as customer_number'),
                  DB::raw('MAX(customer.customer_name) as customer_name'),
                  DB::raw('MAX(customer.status) as status'),
                  DB::raw('MAX(customer.city) as city'),
                  DB::raw('MAX(customer.state) as state'),
                  DB::raw('MAX(customer.type) as type'),
                  DB::raw('MAX(customer.customer_service_id) as customer_service_id'),
                  DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names')
              )
              ->leftjoin('services', 'services.service_id', '=', 'customer.customer_service_id')
              ->groupBy('customer.customer_email');


          // Apply filters based on available parameters

          if (!empty($request->service)) {
              $query->where('customer.customer_service_id', $request->service);
          } if (!empty($request->lead_name)) {
              $query->whereRaw('LOWER(customer.customer_name) LIKE ?', ['%' . strtolower($request->lead_name) . '%']);
          } if (!empty($request->lead_email)) {
              $query->where('customer.customer_email', 'like', '%' . $request->lead_email . '%');
          } if (!empty($request->lead_ph_number)) {
              $query->where('customer.customer_number', 'like', '%' . $request->lead_ph_number . '%');
          } if (!empty($request->lead_city)) {
              $query->where('customer.city', 'like', '%' . $request->lead_city . '%');
          } if (!empty($request->lead_state)) {
              $query->where('customer.state', 'like', '%' . $request->lead_state . '%');
          } if (isset($request->status) && $request->status==0) {
              $query->where('customer.status',0);
          }if (isset($request->status) && $request->status==1) {
              $query->where('customer.status',1);
          }
          // Get the filtered data
             
          $leads_data = $query->paginate(10);
          
      
      }else{
          $role_services=RoleService::where('member_id',$admin_data->user_id)->get();
            if(!empty($role_services)){
               $service_id = [];
                foreach($role_services as $service){
                  $service_id[] = $service->service_id;
                }
                 $query = DB::table('customer')
            ->select(
                'customer.customer_email',
                DB::raw('MAX(customer.customer_id) as customer_id'),
                DB::raw('MAX(customer.customer_number) as customer_number'),
                DB::raw('MAX(customer.customer_name) as customer_name'),
                DB::raw('MAX(customer.status) as status'),
                DB::raw('MAX(customer.city) as city'),
                DB::raw('MAX(customer.state) as state'),
                DB::raw('MAX(customer.type) as type'),
                DB::raw('MAX(customer.customer_service_id) as customer_service_id'),
                DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
            )
            ->leftjoin('services', 'services.service_id', '=', 'customer.customer_service_id')
            ->groupBy('customer.customer_email') 
            ->whereIn('customer.customer_service_id',$service_id);
              if (!empty($request->service)) {
              $query->where('customer.customer_service_id', $request->service);
              } if (!empty($request->lead_name)) {
                  $query->whereRaw('LOWER(customer.customer_name) LIKE ?', ['%' . strtolower($request->lead_name) . '%']);
              } if (!empty($request->lead_email)) {
                  $query->where('customer.customer_email', 'like', '%' . $request->lead_email . '%');
              } if (!empty($request->lead_ph_number)) {
                  $query->where('customer.customer_number', 'like', '%' . $request->lead_ph_number . '%');
              } if (!empty($request->lead_city)) {
                  $query->where('customer.city', 'like', '%' . $request->lead_city . '%');
              } if (!empty($request->lead_state)) {
                  $query->where('customer.state', 'like', '%' . $request->lead_state . '%');
              } if (isset($request->status) && $request->status==0) {
                  $query->where('customer.status',0);
              }if (isset($request->status) && $request->status==1) {
                  $query->where('customer.status',1);
              }
              // Get the filtered data
                 
              $leads_data = $query->paginate(10);
          
            }
            
      }
      /* if($admin_data->user_type == 'admin' || $admin_data->user_type == 'operation_manager'){
          // Base query
          $query = DB::table('customer')
              ->select(
                  'customer.customer_email',
                  DB::raw('MAX(customer.customer_id) as customer_id'),
                  DB::raw('MAX(customer.customer_number) as customer_number'),
                  DB::raw('MAX(customer.customer_name) as customer_name'),
                  DB::raw('MAX(customer.status) as status'),
                  DB::raw('MAX(customer.city) as city'),
                  DB::raw('MAX(customer.state) as state'),
                  DB::raw('MAX(customer.type) as type'),
                  DB::raw('MAX(customer.customer_service_id) as customer_service_id'),
                  DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names')
              )
              ->leftjoin('services', 'services.service_id', '=', 'customer.customer_service_id')
              ->groupBy('customer.customer_email');


          // Apply filters based on available parameters

          if (!empty($request->service)) {
              $query->where('customer.customer_service_id', $request->service);
          } if (!empty($request->lead_name)) {
              $query->whereRaw('LOWER(customer.customer_name) LIKE ?', ['%' . strtolower($request->lead_name) . '%']);
          } if (!empty($request->lead_email)) {
              $query->where('customer.customer_email', 'like', '%' . $request->lead_email . '%');
          } if (!empty($request->lead_ph_number)) {
              $query->where('customer.customer_number', 'like', '%' . $request->lead_ph_number . '%');
          } if (!empty($request->lead_city)) {
              $query->where('customer.city', 'like', '%' . $request->lead_city . '%');
          } if (!empty($request->lead_state)) {
              $query->where('customer.state', 'like', '%' . $request->lead_state . '%');
          } if (isset($request->status) && $request->status==0) {
              $query->where('customer.status',0);
          }if (isset($request->status) && $request->status==1) {
              $query->where('customer.status',1);
          }
          // Get the filtered data
             
          $leads_data = $query->paginate(10);
          
      
      }else if($admin_data->user_type == 'team_manager'){

        $team_manager_services=TeamManagersServicesModel::where('team_manager_id',$admin_data->id)->get();
        if(!empty($team_manager_services)){
           $service_id = [];
            foreach($team_manager_services as $service){
              $service_id[] = $service->managers_services_id;
            }
           $query = DB::table('customer')
            ->select(
                'customer.customer_email',
                DB::raw('MAX(customer.customer_id) as customer_id'),
                DB::raw('MAX(customer.customer_number) as customer_number'),
                DB::raw('MAX(customer.customer_name) as customer_name'),
                DB::raw('MAX(customer.status) as status'),
                DB::raw('MAX(customer.city) as city'),
                DB::raw('MAX(customer.state) as state'),
                DB::raw('MAX(customer.type) as type'),
                DB::raw('MAX(customer.customer_service_id) as customer_service_id'),
                DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
            )
            ->leftjoin('services', 'services.service_id', '=', 'customer.customer_service_id')
            ->groupBy('customer.customer_email') 
            ->whereIn('customer.customer_service_id',$service_id);
              if (!empty($request->service)) {
              $query->where('customer.customer_service_id', $request->service);
              } if (!empty($request->lead_name)) {
                  $query->whereRaw('LOWER(customer.customer_name) LIKE ?', ['%' . strtolower($request->lead_name) . '%']);
              } if (!empty($request->lead_email)) {
                  $query->where('customer.customer_email', 'like', '%' . $request->lead_email . '%');
              } if (!empty($request->lead_ph_number)) {
                  $query->where('customer.customer_number', 'like', '%' . $request->lead_ph_number . '%');
              } if (!empty($request->lead_city)) {
                  $query->where('customer.city', 'like', '%' . $request->lead_city . '%');
              } if (!empty($request->lead_state)) {
                  $query->where('customer.state', 'like', '%' . $request->lead_state . '%');
              } if (isset($request->status) && $request->status==0) {
                  $query->where('customer.status',0);
              }if (isset($request->status) && $request->status==1) {
                  $query->where('customer.status',1);
              }
              // Get the filtered data
                 
              $leads_data = $query->paginate(10);
            
        }
      }else if($admin_data->user_type == 'customer_success_manager'){

          $customer_service=MemberServiceModel::where('member_id',$admin_data->id)->first();
          $query = DB::table('customer')
            ->select(
                'customer.customer_email',
                DB::raw('MAX(customer.customer_id) as customer_id'),
                DB::raw('MAX(customer.customer_number) as customer_number'),
                DB::raw('MAX(customer.customer_name) as customer_name'),
                DB::raw('MAX(customer.status) as status'),
                DB::raw('MAX(customer.city) as city'),
                DB::raw('MAX(customer.state) as state'),
                DB::raw('MAX(customer.type) as type'),
                DB::raw('MAX(customer.customer_service_id) as customer_service_id'),
                DB::raw('GROUP_CONCAT(services.name ORDER BY services.name ASC SEPARATOR ", ") as service_names') 
            )
            ->leftjoin('services', 'services.service_id', '=', 'customer.customer_service_id')
            ->groupBy('customer.customer_email') 
            ->whereJsonContains('customer.team_member',"$admin_data->id");
              if (!empty($request->service)) {
              $query->where('customer.customer_service_id', $request->service);
              } if (!empty($request->lead_name)) {
                  $query->whereRaw('LOWER(customer.customer_name) LIKE ?', ['%' . strtolower($request->lead_name) . '%']);
              } if (!empty($request->lead_email)) {
                  $query->where('customer.customer_email', 'like', '%' . $request->lead_email . '%');
              } if (!empty($request->lead_ph_number)) {
                  $query->where('customer.customer_number', 'like', '%' . $request->lead_ph_number . '%');
              } if (!empty($request->lead_city)) {
                  $query->where('customer.city', 'like', '%' . $request->lead_city . '%');
              } if (!empty($request->lead_state)) {
                  $query->where('customer.state', 'like', '%' . $request->lead_state . '%');
              } if (isset($request->status) && $request->status==0) {
                  $query->where('customer.status',0);
              }if (isset($request->status) && $request->status==1) {
                  $query->where('customer.status',1);
              }
              // Get the filtered data                
              $leads_data = $query->paginate(10);


        }*/

    return view('admin.dashboard.view_leads',['services'=>$service_details,'admin_data'=>$admin_data,'data'=>$leads_data,]);

    }

    
    public function updateServiceData(Request $request){

        if (empty($request->customer_id) || empty($request->package_id)) {
            return self::toastr(false, "Please Choose Packages", "error", "Error");
        }
      
      $customer_id=$request->customer_id;
      $services=$request->main_service_id;
      $subservices=$request->service_id;
      $sub_sunservices=$request->sub_service_id;
      $packages=$request->package_id;
      
        // echo "<pre>";
        // print_r($customer_id);
        // print_r($services);
        // print_r($subservices);
        // print_r($packages);
        // die;

  
        $delete = CustomerServiceModel::where("customer_main_id",$customer_id)->delete();
          foreach ($services as $key => $value) {
           $create = new CustomerServiceModel();
           $create->customer_main_id = $customer_id;
           $create->customer_service_id = $value;
           $create->save();
        }
        if(!empty($packages)){
          $delete = CustomerPackageModel::where("customer_main_id",$customer_id)->delete();
           foreach ($packages as $key => $value) {
           $create = new CustomerPackageModel();
           $create->customer_main_id = $customer_id;
           $create->customer_package_id = $value;
           $create->save();
        }
          if(!empty($subservices)){
          $delete = CustomerSubServiceModel::where("customer_main_id",$customer_id)->delete();
           foreach ($subservices as $key => $value) {
           $create = new CustomerSubServiceModel();
           $create->customer_main_id = $customer_id;
           $create->customer_subservice_id = $value;
           $create->save();
        }
      }
    }
       return response()->json($customer_id);
    }


    
    public function getPackagesByServiceId($serviceIds)
    {
        $sIds = explode(',', $serviceIds);
        $packages = Package::whereIn('service_id', $sIds)->get();
        return response()->json($packages);
    }

}