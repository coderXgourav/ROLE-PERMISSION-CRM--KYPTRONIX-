<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Models\Service;
use App\Models\invoice;
use App\Models\PaymentModel;
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

    // echo "<pre>";
    // print_r($_POST);
    // die;

    $invoice_id = $request->invoice_id;
    $lead_id = $request->lead_id;
    $amount = $request->amount;
    $email = $request->stripeEmail;
    
        $request->validate([
            'stripeToken' => 'required'
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));
        
        try {
            $payment_details = new PaymentModel;
            $payment_details->lead_invoice_id = $invoice_id;
            $payment_details->leads_id = $lead_id;
            $payment_details->amount = $amount;
            $payment_details->payment_email = $email;
            $payment_details->save();

            Charge::create([
                'amount' => $amount*100, 
                // 'amount' => $request->amount * 100, 
                'currency' => 'usd',
                'description' => 'Payment Description',
                'source' => $request->stripeToken,
            ]);

            $update_payments = PaymentModel::find($payment_details->payment_id);
            $update_payments->pay_status = 1;
            $update_payments->save();

            $invoice = Invoice::find($invoice_id);
            $invoice->payment_status = 1;
            $invoice->save();
            
            $customer = CustomerModel::find($lead_id);
            $customer->paid_customer = 1;
            $customer->save();

            return view('admin.success',['amount'=>$amount]);
        } catch (\Exception $e) {
            return view('admin.failed',['amount'=>$amount]);

            // return back()->with('error', $e->getMessage());
        }
}

}