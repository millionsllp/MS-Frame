<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   

       // dd(session('user'));

        if(!($request->session()->has('user'))){
            return  redirect()->action('\BECM\MS_Flex\Users\Controller@login');
        }
        return $next($request);
    }
}
