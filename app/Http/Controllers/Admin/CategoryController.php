<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    public function index(){

        $categories = Category::paginate(10);

        

        return view('admin.CategoryForm',compact("categories"));

    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $category = new Category;       

        $category -> name = $request->name;
        $category->save();
        Session()->flash("success","บันทึกข้อมูลเรียบร้อยแล้ว!");
        return redirect('/admin/createCategory');

    }


    public function edit(Request $request,$id){
         $category=Category::find($id);

         return view('admin.EditCategoryForm',['category'=>$category]);
    }

    public function update(Request $request,$id){
        
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $category=Category::find($id);

        $category -> name = $request ->name;
        $category ->save();
        Session()->flash("success","อัพเดทข้อมูลเรียบร้อยแล้ว!");
        return redirect('/admin/createCategory');
   }

   public function delete($id){
        $category = Category::find($id);
        //เช็คเงื่อนไขว่าผูกความสัมพันธ์กันหรือเปล่า 
        if($category->products->count()>0){
            Session()->flash("warning","ไม่สามารถลบหมวดหมู่ได้ เพราะมีสินค้าใช้งานหมวดหมู่นี้");
            return redirect()->back();
        }

        //ทำลายแถวที่มี id ส่งมา
        $category::destroy($id);
        Session()->flash("success","ลบข้อมูลเรียบร้อยแล้ว!");
        return redirect('/admin/createCategory');
}



}
