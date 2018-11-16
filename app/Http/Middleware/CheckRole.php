<?php

namespace App\Http\Middleware;

use Closure;
use App\UserRole;
use App\Customer;
use Log;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $value = $request->cookie('username');

        if(empty($value)){
            return redirect('403');
        }
        else{
            $user  = Customer::where('username', $value)->get()->first();
            if(!empty($user)){
                $userrole = UserRole::where('userid', $user->userid)->get()->first();

                if(!empty($userrole)){
                    if($userrole->roleid != 1){
                        return redirect('403');
                    }
                }
                else {
                    return redirect('403');
                }
            }
            else {
                return redirect('403');
            }
            
            return $next($request);
        }
    }
}
