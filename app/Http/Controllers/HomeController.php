<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Models\Service;
use Stripe\Stripe;
use Stripe\Charge;

class HomeController extends Controller
{

  public function index(Request $request){
     $service = Service::all();
     return view('index',['service'=>$service]);

  }
        //   THIS IS A  SWAL FUNCTION 
   public function swal($status , $title ,$icon){
        return response()->json([
             'status'=>$status,
             'title'=>$title,
             'icon'=>$icon 
        ]);
    }
//   THIS IS A  SWAL FUNCTION 
//   THIS IS A formSubmit FUNCTION 
public function formSubmit(Request $request){
     $name = $request->name;
      $phone = $request->phone;
      $country_code = $request->country_code;
     $a = $country_code.$phone;
     $email = $request->email;
     $msg = $request->msg;
     $service = $request->service;
     
     $details = new CustomerModel;
     $details->customer_name = $name;
     $details->customer_number = $a;
     $details->customer_email = $email;
     $details->customer_service_id = $service;
     $details->msg = $msg;
     $save = $details->save();
     if($save){
        return self::swal(true,"Submited",'success');
     }else{
        return self::swal(false,"Try Again Later",'error');
     }
     
     
}
//   THIS IS A formSubmit FUNCTION 

public function store(Request $request){
        $request->validate([
            'stripeToken' => 'required'
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));
        
        try {
            Charge::create([
                'amount' => 1*100, 
                // 'amount' => $request->amount * 100, 
                'currency' => 'usd',
                'description' => 'Payment Description',
                'source' => $request->stripeToken,
            ]);

            return back()->with('success', 'Payment Successful!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
}

}