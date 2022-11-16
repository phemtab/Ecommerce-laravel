<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class VerifyIsAdmin
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
        //check ว่าเป็น Admin ได้ค่า 1 ไหม (เป็น boolean) และ(and) login หรือเปล่า 
        if(Auth::user()->CheckIsAdmin() && Auth::check()){
            return $next($request);
        }

        //ไม่ใช่ Admin จะแสดงแบบนี้
        return redirect("/login");
      
    }
}
