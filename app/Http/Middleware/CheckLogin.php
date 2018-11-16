<?php

namespace App\Http\Middleware;

use Closure;
use App\UserRole;
use App\Customer;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   $value = $request->cookie('username');

        if(empty($value)){
            return redirect('403');
        }
        else{
            $user  = Customer::where('username', $value)->first();
            if(empty($user)){
                return redirect('403');
            }
            
            return $next($request);
        }
    }
}
