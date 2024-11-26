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
        $user_type = self::userType($admin_data->user_type);
        $service_details = Service::where('name','!=','uncategorized')->orderBy('service_id','DESC')->get();

        $lead_name=$request->lead_name;
       if($admin_data->user_type == 'admin' || $admin_data->user_type == 'operation_manager'){
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


        }

    return view('admin.dashboard.view_leads',['services'=>$service_details,'admin_data'=>$admin_data,'data'=>$leads_data,'user_type'=>$user_type]);

    }
    public function updateServiceData(Request $request){
      $customer_ids=$request->customer_id;
      $c_ids=explode(',', $customer_ids);
      $services=$request->service_id;
      $type=$request->type;

      $business_name=$request->business_name;
      $industry=$request->industry;
      $fax=$request->fax;
      $contact_number=$request->contact_number;
      $contact_email=$request->contact_email;
      $ein=$request->ein;
      $business_title=$request->business_title;
      $msg=$request->msg;
      $point_of_contact=$request->point_of_contact;
      $paid_customer=$request->paid_customer;

      if(!empty($request->packages)){
          $packages=implode(',',$request->packages);
      }else{$packages=0;}

      if(!empty($request->subservices)){
          $subservices=implode(',',$request->subservices);
      }else{$subservices=0;}
      if(!empty($c_ids)){
         foreach ($c_ids as $key => $value) {
           $delete=CustomerModel::find($value)->delete();
         }
     
      }else{
           $delete=CustomerModel::find($customer_ids)->delete();

      }
      
      if($type==1){
           $phone= $request->customer_number;
           //$country_code = $request->country_code;
           $customer_number = $phone;
           $first_name = $request->first_name;
           $middle_name =$request->middle_name;
           $last_name=$request->last_name;
            $email = $request->customer_email;
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
          if(!empty($services)){
              foreach ($services as $key => $value) {
                $individual_details = new CustomerModel;
                $individual_details->customer_name = $customer_name;
                $individual_details->customer_number = $customer_number ;
                $individual_details->customer_email = $email ;
                $individual_details->customer_service_id = $value;
                $individual_details->customer_sub_service_id = $subservices;
                $individual_details->package_id = $packages;
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
                $save = $individual_details->save();
                $customer_id=encrypt($individual_details->customer_id);

             }
          }else{
               $individual_details = new CustomerModel;
                $individual_details->customer_name = $customer_name;
                $individual_details->customer_number = $customer_number ;
                $individual_details->customer_email = $email ;
                $individual_details->customer_service_id = 0;
                $individual_details->customer_sub_service_id =$subservices;
                $individual_details->package_id = $packages;
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
                $save = $individual_details->save();
                $customer_id=encrypt($individual_details->customer_id);
          }      
      }else if($type==2){
        $email_address = $request->customer_email;
        $fax = $request->fax;
        $contact_number = $request->customer_number;
        $business_name=$request->business_name;
        $industry=$request->industry;
        $address=$request->address;
        $city=$request->city;
        $state=$request->state;
        $zip=$request->zip;
          
        $customer_email = $email_address;
        $ein=$request->ein;
        $business_title=$request->business_title;
        $point_of_contact=$request->point_of_contact;
        $msg=$request->msg;
        
        if(!empty($services)){
           foreach ($services as $key => $value) {
                $business_details = new CustomerModel;
                $business_details->business_name=$business_name;
                $business_details->customer_name=$business_name;
                $business_details->industry=$industry;
                $business_details->customer_number=$contact_number;
                $business_details->customer_email=$customer_email;
                $business_details->customer_service_id = $value;
                $business_details->customer_sub_service_id = $subservices;
                $business_details->package_id = $packages;

                $business_details->type=$type;
                $business_details->ein=$ein;
                $business_details->address=$address;
                $business_details->city=$city;
                $business_details->state=$state;
                $business_details->zip=$zip;
                $business_details->business_title=$business_title;
                $business_details->point_of_contact=$point_of_contact;

                $business_details->fax=$fax;
                $business_details->contact_number=$contact_number;
                $business_details->contact_email=$email_address;

                $business_details->msg=$msg;
                $save = $business_details->save();
                $customer_id=encrypt($business_details->customer_id);


           }
        }else{
                $business_details = new CustomerModel;
                $business_details->business_name=$business_name;
                $business_details->customer_name=$business_name;
                $business_details->industry=$industry;
                $business_details->customer_number=$contact_number;
                $business_details->customer_email=$customer_email;
                $business_details->customer_service_id = 0;
                $business_details->customer_sub_service_id = $subservices;
                $business_details->package_id = $packages;

                $business_details->type=$type;
                $business_details->ein=$ein;
                $business_details->address=$address;
                $business_details->city=$city;
                $business_details->state=$state;
                $business_details->zip=$zip;
                $business_details->business_title=$business_title;
                $business_details->point_of_contact=$point_of_contact;

                $business_details->fax=$fax;
                $business_details->contact_number=$contact_number;
                $business_details->contact_email=$email_address;

                $business_details->msg=$msg;
                $save = $business_details->save();
                $customer_id=encrypt($business_details->customer_id);


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