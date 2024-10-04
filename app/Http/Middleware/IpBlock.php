<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IpBlock
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
          $ip = $request->ip();
          
           $blockedIps = [
            '14.97.102.174', 
            '14.97.104.174', 
        ];

            if (in_array($ip, $blockedIps)) {
                return $next($request);
            }
            return redirect('/');

    }
}