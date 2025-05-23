<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\AdminModel;
use App\Models\TeamMember; 
use App\Models\Invoice;
use App\Models\CustomerModel;
use DB;
use Crypt;

class SuperServiceController extends Controller
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
   
    // THIS IS serviceAdd FUNCTION 
    public function serviceAdd(Request $request){
      $name = $request->name;
     if(Service::where('name',$name)->first()){
         return self::toastr(false,"Service Name Already Registered","error","Error");
     }
     
      $service_details = new Service;
      $service_details->name = $name;
      $save = $service_details->save();
      if($save){
         return self::toastr(true,"Service Add Successfull","success","Success");
      }else{
         return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      }
      
    }
    // THIS IS serviceAdd FUNCTION 
    //AllService Start
    public function allServices(){
	  $id = session('admin');
	   $admin_data = AdminModel::find($id);
	   $services = Service::orderBy('service_id','DESC')->get();
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
    $admin_data = AdminModel::find($id);
    $s_id =   Crypt::decrypt($service_id);
    $data = Service::find($s_id);
   return view('admin.dashboard.edit_service',['admin_data'=>$admin_data,'data'=>$data]);
   
  }
  //editService End
  //updateService Start
  public function updateService(Request $request){
      $name = $request->name;
      $service_id = $request->service_id;
      $service_details = Service::find($service_id);
      $service_details->name = $name;
      $save = $service_details->save();
      if($save){
         return self::toastr(true,"Service Details Updated Successfull","success","Success");
      }else{
         return self::toastr(false,"Sorry , Technical Issue..","error","Error");
      }
  } 
  //updateService End
  //viewService Start
  public function viewService($service_id){
    $id = session('admin');
    $admin_data = AdminModel::find($id);
    $s_id =   Crypt::decrypt($service_id);
    $data = Service::find($s_id);
    $team_member=TeamMember::where('team_service',$s_id)->get();
    $leads=CustomerModel::where('customer_service_id',$s_id)->count();
    $invoice =Invoice::where('service_id',$s_id)->count();
   return view('admin.dashboard.view_service',['admin_data'=>$admin_data,'data'=>$data,'total_team_member'=>$team_member,'total_leads'=>$leads,'total_invoices'=>$invoice]);
   
  }
  //viewService End
  //teamMember Start
 public function teamMember($service_id){
     $id = session('admin');
     $admin_data = AdminModel::find($id);
     $team_member = DB::table('team_member')
    ->join('services', 'services.service_id', '=', 'team_member.team_service')
    ->select('team_member.*', 'services.name as service_name')
    ->where('team_member.team_service',$service_id)
    ->get();
    return view('admin.dashboard.service_team_members',['admin_data'=>$admin_data,'team_member'=>$team_member]);
}
//teamMember End
//showLeadsList Start
public function showLeadsList($service_id){
    $id = session('admin');
    $admin_data = AdminModel::find($id);
    $clients = DB::table('customer')
    ->join('services','services.service_id','=','customer.customer_service_id')
    ->select('customer.*','services.name as service_name')
    ->where('customer.customer_service_id',$service_id)
    ->get();
   return view('admin.dashboard.show_leads_lists',['admin_data'=>$admin_data,'clients'=>$clients]);
}
//showLeadsList End
//serviceInvoices Start
public function serviceInvoices($service_id){
    $id = session('admin');
    $admin_data = AdminModel::find($id);
     $invoice = DB::table('invoices')
     ->select('team_member.name as team_member_name','user.name as team_manager_name','invoices.role','invoices.price as invoices_price','customer.customer_name','customer.customer_number','invoices.created_at','invoices.invoice_id','customer.customer_id','invoices.service_id')
     ->join('customer','customer.customer_id','=','invoices.customer_id')
     ->leftjoin('team_member','team_member.team_member_id','=','invoices.team_member_id')
     ->leftjoin('user','user.user_id','=','invoices.team_manager_id')
     ->where('invoices.service_id',$service_id)
     ->get();
    //echo "<pre>";
   // print_r($invoice);die;
   return view('admin.dashboard.service_invoices',['admin_data'=>$admin_data,'data'=>$invoice]);
}
//serviceInvoices End

}