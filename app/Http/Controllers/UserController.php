<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaidCustomer;
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
           return self::swal(true,'Login Successfull','success');
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

}
