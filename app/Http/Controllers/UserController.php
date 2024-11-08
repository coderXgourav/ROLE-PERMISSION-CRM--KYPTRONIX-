<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaidCustomer;
use App\Models\File;
use DB;

class UserController extends Controller
{

	   public function swal($status , $title ,$icon){
        return response()->json([
             'status'=>$status,
             'title'=>$title,
             'icon'=>$icon 
        ]);
    }
    //
    public function login(Request $request){
    	$username=$request->username;
    	//print_r($username);die;
    	$password = $request->password;
       
       $check_paid_customer = PaidCustomer::where('email',$username)->first();
       
       if($check_paid_customer){
         if($check_paid_customer->password  == $password){
           session()->put('customer',$check_paid_customer->paid_customer_id);
           return self::swal(true,'Login Successfully','success');
         }else{
       return self::swal(false,'Invalid Password','error');
         }
       }else{
       return self::swal(false,'Invalid  Email','error');
       }

    }
   public function logout(){
	  session()->forget('customer');
	  return redirect('/customer/login');
   }
   public function customerDashboard(){
   	 $id=session('customer');
   	 return view('user.dashboard.index',['customer_id'=>$id]);
   }
   public function fileUpload(Request $request){
      
   	   $customer_id=$request->paid_customer_id;
      $customer_data = PaidCustomer::find($customer_id);

   	   $request->validate([
            'file' => 'required|file|mimes:jpeg,png,pdf,webp|max:10240', // Max 10MB
        ]);
        
        if ($request->hasFile('file')) {
            // Get the file from the request
            $file = $request->file('file');
            $ex = $file->getClientOriginalExtension();
          //   if($ex!="jpeg"||$ex!="png"||$ex!="pdf"||$ex!="webp"){
          //  return self::swal(true,'The file field must be a file of type: jpeg, png, pdf, webp, ','error');
              
          //   }

            // Generate a unique name for the file and store it in the public directory
            $filename=uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->move('uploads',$filename );
            $file_data=new File;
            $file_data->paid_customer_id=$customer_id;
            $file_data->customer_id=$customer_data->customer_id;
            $file_data->file=$filename;
            $file_data->save();
           // print_r($path);die;
           return self::swal(true,'File uploaded successfully','success');
 

        } else {
           return self::swal(false,'Unable to upload file','error');

        }

   }
   public function viewFiles(){
      $id=session('customer');
      $file_data=File::where('paid_customer_id',$id)->paginate(10);
      return view('user.dashboard.all_files',['file_data'=>$file_data]);
   }
   public function fileShow($filename){
    return view('user.dashboard.file_view',['filename'=>$filename]);

  }
  
  
  
}