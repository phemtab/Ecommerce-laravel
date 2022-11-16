<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware("verifyIsCategory")->only(['create']);
    }


    public function index(){

        return view('admin.ProductDashboard')->with('products',Product::paginate(6));
    }

    public function create(){

        return view('admin.ProductForm')->with('categories',Category::all());
    }

    public function showUsers(){
        $users = DB::table('users')->paginate(10);
        return view('admin.disPlayerUser',["users"=>$users]);
    }



    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'description'=>'required',
            'category'=>'required',
            'price'=>'required|numeric',
            'image'=>'required|file|image|mimes:jpeg,png,jpg|max:5000'
        ]);
        //gen base64 
        $stringImageReFormat = base64_encode('_'.time());
        //นามสกุลภาพที่ส่งมา
        $ext = $request -> file('image')->getClientOriginalExtension();
        //นำ path เก็บลงใน database
        $imageName = $stringImageReFormat.".".$ext;

        //รับไฟล์มา
        $imageEncoded =File::get($request->image);

        //เก็บที่ Storages
        Storage::disk('local')->put('public/product_image/'.$imageName,$imageEncoded);

        $product = new Product;
        $product -> name = $request->name;
        $product -> description = $request->description;
        $product -> category_id = $request -> category;
        $product -> price = $request -> price;
        $product -> image = $imageName;
        $product -> save();

        //Flash Message ก่อน Redirect จะส่งข้อความตอบกลับ
        Session()->flash("success","บันทึกข้อมูลเรียบร้อยแล้ว!");


        return redirect('/admin/dashboard');

    }

    public function edit($id){
        
        return view('admin.editProductForm')
        ->with('categories',Category::all())
        ->with('products',Product::find($id));


    }

    public function editImage($id){
        $product = Product::find($id);
        return view('admin.editProductImage')->with('products',$product);

    }


    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'description'=>'required',
            'category'=>'required',
            'price'=>'required|numeric'
        ]);

        $product = Product::find($id);
        $product -> name=$request->name;
        $product -> description=$request->description;
        $product -> price = $request -> price;

        if($request -> category){
            $product->category_id = $request -> category;
        }

        $product -> save();
        Session()->flash("success","อัพเดทข้อมูลเรียบร้อยแล้ว!");
        return redirect('/admin/dashboard');

    }

    public function updateImage(Request $request,$id){
        $request->validate([
            'image'=>'required|file|image|mimes:jpeg,png,jpg|max:5000'
        ]);

        if($request->hasFile("image")){


            $product = Product::find($id);
            //check ว่าภาพใดที่มีชื่อเหมือนกัน
            $exists = Storage::disk('local')->exists("public/product_image/".$product->image);
            // เจอแล้วลบทิ้ง
            if($exists){
                Storage::delete("public/product_image/".$product->image);
            }
            //จัดเก็บในชื่อไฟล์เดิม
            $request ->image -> storeAs("public/product_image/",$product->image);

            Session()->flash("success","อัพเดทภาพเรียบร้อยแล้ว!");
            return redirect('/admin/dashboard');


        }


    }

    public function delete($id){
        $product = Product::find($id);

        //ลบภาพสินค้าออกด้วย
        $exists = Storage::disk('local')->exists("public/product_image/".$product->image);
        // เจอแล้วลบทิ้ง
        if($exists){
            Storage::delete("public/product_image/".$product->image);
        }


            Product::destroy($id);

            Session()->flash("success","ลบข้อมูลเรียบร้อยแล้ว!");
            return redirect('admin/dashboard');

    }

    public function orderPanel(){
        $orders=DB::table('orders')->paginate(10);
        return view('admin.OrderPanel',["orders"=>$orders]);
    }

    public function showOrderDetail($id){
        //่join ข้อมูล 2 ตาราง ที่มี orderID ตรงกัน
        $orderitems = DB::table('orders')
        ->join('orderitems','orders.order_id','=','orderitems.order_id')
        ->where('orders.order_id',$id)
        ->get();
        return view('admin.orderDetails',["orderitems"=>$orderitems]);
    }




}
