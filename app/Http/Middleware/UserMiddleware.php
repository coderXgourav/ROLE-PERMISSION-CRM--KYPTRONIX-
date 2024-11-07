<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;
use Session;
class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // return $next($request);
    	   if (Session::has('customer')) {
            $id = Session::get('customer');
            $paid_customer_data = DB::table('paid_customer')
                ->where('paid_customer.paid_customer_id', $id)
                ->first();

            if ($paid_customer_data) {
                 return $next($request); 
            }
        }else{
            return  redirect('/customer/login');
        }

        return redirect('/not-access')->with('error', 'Unauthorized access.');
 
    }
}
