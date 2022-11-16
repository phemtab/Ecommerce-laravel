<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;

class VerifyCategory
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
        // Query มาทั้งหมดแล้วก็นับเลยว่าเท่ากับ 0 ไหม
        if(Category::all()->count()==0){
            //ระวังมันไม่ได้อ้างอิงเหมือนตัว Model
            Session()->flash('warning',"ต้องเพิ่มประเภทสินค้าอย่างน้อย 1 รายการ");
            return redirect("/admin/createCategory");
        }

        // มีประเภทอยู่แล้วจะทำงานปกติ
        return $next($request);
    }
}
