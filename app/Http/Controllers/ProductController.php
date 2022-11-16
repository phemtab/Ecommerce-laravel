<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){

        return view('products.showProduct')
        ->with("products",Product::paginate(6))
        ->with("categories",Category::all()->sortByDesc('name'));
        //เรียงลำดับโดยชื่อ(สินค้าทุกชนิด)
    }

    //แสดงหมวดหมู่ของสินค้า
    public function showCategory($id){

        $category = Category::find($id);
        // ถ้ารู้ ID หมวดหมู่จะรู้สินค้่าได้
        
        return view("products.showCategory")
        ->with("categories",Category::all()->sortBy('name'))
        ->with("products",$category->products()->paginate(3))
        ->with("feature",$category->name);   
    }
    //แสดงรายละเอียดของสินค้า
    public function details($id){

        return view ("products.showProductdetails")
        ->with("product",Product::find($id))
        ->with("categories",Category::all()->sortBy('name'));

    }

    public function addProductToCart(Request $request,$id){
        // $request->session()->forget('cart'); //ทำลาย Session ทิ้ง
        $product= Product::find($id);
        //ทำงานร่วมกับตะกร้าสินค้ายังไง?
        $prevCart = $request->session()->get('cart');
        //ตะกร้าใหม่สร้่าง object 
        $cart = new Cart($prevCart);
        $cart -> addItem($id,$product);
        $cart -> updatePriceQuantity();
        //update ตระกร้าสินค้า
        $request->session()->put('cart',$cart);
     
        return redirect('/products/cart');
        
    }
    //เพิ่มจำนวนสินค้าในหน้า Detail
    public function addQuantityToCart(Request $request){
        $id = $request ->_id;
        $quantity = $request -> quantity;

         // $request->session()->forget('cart'); //ทำลาย Session ทิ้ง
         $product= Product::find($id);
         //ทำงานร่วมกับตะกร้าสินค้ายังไง?
         $prevCart = $request->session()->get('cart');
         //ตะกร้าใหม่สร้่าง object 
         $cart = new Cart($prevCart);
         $cart -> addQuantity($id,$product,$quantity);
        //ให้ตะกร้าสินค้าจัดเรียงใหม่ และหาผลรวมใหม่
        $cart -> updatePriceQuantity();
         //update ตระกร้าสินค้า
         $request->session()->put('cart',$cart);

        return redirect('/products/cart');
    }
    //กดคลิกเข้าตะกร้าสินค้า แบบมีเงื่อนไข
    public function showCart(){
        $cart = Session::get('cart'); //ดึงข้อมูลจากตะกร้าสินค้า

        if($cart){
            return view('products.showCart',['cartItems'=>$cart]); //โยนข้อมูลเป็นก้อนเก็บใน cartItems ถ้ามีตะกร้าสินค้าจะมี cartItems ขึ้นมา
        }

        else{
            return redirect('/products');
        }

    }

    public function deleteFromCart(Request $request,$id){
        //get ตะกร้าสินค้า
        $cart = $request->session()->get('cart');

        // เปรียบเทียบ id ที่ส่งมา กับ id ในตะกร้าสินค้า เช่น 13,14,15 
        if(array_key_exists($id,$cart->items)){
            //ทำลายเฉพาะตามไอดีที่ส่งมาเป็นชิ้นๆ
            unset($cart->items[$id]);
        }
        //ดึงตะกร้ามาใช้งาน (ตะกร้าหลังลบ)
        $afterCart = $request ->session() -> get('cart');
        //สร้าง object ตัวใหม่เอาสินค้าคงเหลือโยนไปทำงานเพื่อจับคู่เพื่อ set ค่า default properties อีกครั้งนึง
        $updateCart = new Cart($afterCart);
        //จัดเรียงราคาใหม่ ตาม Cart หลังลบ ไม่ให้เกิดข้อผิดพลาด
        $updateCart->updatePriceQuantity();
        //ทำการเรียก Session มาใหม่หลังจาก update แล้ว
        $request -> session()->put('cart',$updateCart);
        return redirect('/products/cart');

    }

    //กดปุ่มเพิ่มจำนวนสินค้า
    public function incrementCart(Request $request,$id){
        // $request->session()->forget('cart'); //ทำลาย Session ทิ้ง
        $product= Product::find($id);
        //ทำงานร่วมกับตะกร้าสินค้ายังไง?
        $prevCart = $request -> session()->get('cart');
        //ตะกร้าใหม่
        $cart = new Cart($prevCart);
        $cart -> addItem($id,$product);
        //update ตระกร้าสินค้า
        $request->session()->put('cart',$cart);
        return redirect('/products/cart');
    }

    //กดปุ่มลบสินค้า
    public function decrementCart(Request $request,$id){
        //key array = 13
        // $request->session()->forget('cart'); //ทำลาย Session ทิ้ง
        $product= Product::find($id);
        //ทำงานร่วมกับตะกร้าสินค้ายังไง?
        $prevCart = $request -> session()->get('cart');
        //สร้างตะกร้าสินค้าขึ้นมาใหม่(ส่งตะกร้าสินค้าตัวเก่าไปทำงานที่อยู่ใน Session)
        $cart = new Cart($prevCart);
        //วิ่งไปที่ item id ช่อง quantity ของสินค้าที่เลือก
        if($cart->items[$id]['quantity']>1){
            //เปลี่ยนแปลงช้อง Quantity ลดลง 1
            $cart -> items[$id]['quantity'] = $cart->items[$id]['quantity']-1;
            $cart -> items[$id]['totalSinglePrice'] = $cart->items[$id]['quantity']*$product['price']; //คำนวณราคารวมใหม่
            $cart -> updatePriceQuantity();

            $request -> session () ->put ('cart',$cart);
        }
        else{
            Session()->flash('warning',"ต้องมีสินค้าอย่างน้อย 1 รายการ");
        }
        return redirect('/products/cart');

    }

    //ค้นหาด้วยข้อความ
    public function searchProduct(Request $request){
        $name = $request->search;
        $products = Product::where('name','LIKE',"%{$name}%")->paginate(1);
       
        return view("products.searchProduct")
        ->with("products",$products)
        ->with("categories",Category::all()->sortBy('name'));
    }

    public function searchProductPrice(Request $request){
        //จะได้ Array เก็บค่าสองค่าเป็นค่า minimum กับ maximum แยกด้วย ,
        $arrPrice = explode(",",$request->price);
        $products = Product::whereBetween('price',$arrPrice);
        
        return view('products.showProduct')
        ->with("products",$products->paginate(3))
        ->with("categories",Category::all()->sortBy('name'));
    }

    public function checkout(Request $request){
       return view('products.checkoutPage');
    }

    public function createOrder(Request $request){
        $cart = Session::get('cart');
        $email = $request ->email;
        $fname = $request ->fname;
        $lname = $request ->lname;
        $address = $request ->address;
        $zip = $request ->zip;
        $phone = $request -> phone;
        $user_id = Auth::id();
        //Check ว่ามีสินค้าในตะกร้าหรือเปล่า 
        if($cart){
            $date = date("Y-m-d H:i:s");
            //โยนเข้าตาราง order
            $newOrder =array(
            "date"=>$date,
            "price"=>$cart->totalPrice,
            "status"=>"Not Paid",
            "del_date"=>$date,
            "fname"=>$fname,
            "lname"=>$lname,
            "address"=>$address,
            "email"=>$email,
            "zip"=>$zip,
            "phone"=>$phone,
            "user_id"=>$user_id
        );
            //Insert Order Data
            $create_order = DB::table('orders')->insert($newOrder);
            $order_id = DB::getPDO()->lastInsertId();

            //เข้าถึงตะกร้าสินค้า loop ตะกร้าสินต้าทีละรายการ (Insert Order Item Data)
            foreach ($cart -> items as $item){
                $item_id = $item['data']['id'];
                $item_name = $item['data']['name'];
                $item_price = $item['data']['price'];
                $item_amount = $item['quantity'];
                $newOrderItem = array(
                    "item_id"=>$item_id,
                    "order_id"=>$order_id,
                    "item_name"=>$item_name,
                    "item_price"=>$item_price,
                    "item_amount"=>$item_amount
                );

                $create_orderItem = DB::table("orderitems")->insert($newOrderItem);
            }
            //บันทึกแล้ว clear ตะกร้าทิ้ง
            Session::forget("cart");
            $payment_info = $newOrder;
            $payment_info["order_id"] = $order_id;
            $request->session()->put("payment_info",$payment_info);
            
            return redirect('/products/showPayment');
        }
        else {
            return redirect('/products');
        }

    }

    public function showPayment(){
        $payment_info = Session::get('payment_info');
        
        if($payment_info['status']=='Not Paid'){
            return view("payment.paymentPage",["payment_info"=>$payment_info]);
        }
        else{
            return redirect('/products');
        }
        
    }


}
