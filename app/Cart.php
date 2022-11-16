<?php

namespace App;

class Cart{
    //ประกาศตัวแปร
    public $items; //Array เก็บข้อมูลของสินค้าในตระกร้าทั้งหมด Array ซ้อน Array
    public $totalQuantity; //จำนวนสินค้าในตระกร้ารวม
    public $totalPrice; //จำนวนราคารวม

    public function __construct($prevCart){
        //ตะกร้าเก่าเอามาใช้ต่อ
        if($prevCart!=null){
            $this->items= $prevCart->items;
            $this->totalQuantity= $prevCart->totalQuantity;
            $this->totalPrice= $prevCart->totalPrice;
        }
        else{
        //ตะกร้าใหม่
            $this->items=[];
            $this->totalQuantity=0;
            $this->totalPrice=0;
        }
       
    }
    //ฟังก์ชันทำงานร่วมกับ Controller
    public function addItem($id,$product){
        //ทำให้เป็น Int จากก้อนข้อมูลที่ส่งมาจาก database
        $price = (int)($product->price);
        //เอาไอดีที่ส่งมามาเช็คกับ Array item ว่า Key ตรงกันไหม เอาของเก่าเพิ่มกับของใหม่ ถ้าสินค้าชนิดเดียวกัน
        if(array_key_exists($id,$this->items)){
            //อ้างถึง items ที่มี id เท่ากับ id ที่ส่งมา
            $productToAdd = $this->items[$id];
            //เข้าถึง Key Quantity แล้วก็เพิ่มทีละ 1
            $productToAdd['quantity']++; //เพิ่มจำนวนรายการสินค้า่นั้นๆ
            $productToAdd['totalSinglePrice']=$productToAdd['quantity']*$price; //price เป็นค่าตายตัว
        }
        else{
        //กำหนดค่าเริ่มต้นเก็บข้อมูลภายใน items,totalquantity,totalprice ถ้า id ไม่ซ้ำ
        $productToAdd = ['quantity'=>1,'totalSinglePrice'=>$price,'data'=>$product];
        }
        $this->items[$id]=$productToAdd;
        $this->totalQuantity++;
        $this->totalPrice= $this->totalPrice + $price; 
        
    }


     //ฟังก์ชันทำงานร่วมกับ Controller
     public function addQuantity($id,$product,$amount){
       if($amount>0){
             //ทำให้เป็น Int จากก้อนข้อมูลที่ส่งมาจาก database
        $price = (int)($product->price);
        //เอาไอดีที่ส่งมามาเช็คกับ Array item ว่า Key ตรงกันไหม เอาของเก่าเพิ่มกับของใหม่ ถ้าสินค้าชนิดเดียวกัน
        if(array_key_exists($id,$this->items)){
            //อ้างถึง items ที่มี id เท่ากับ id ที่ส่งมา
            $productToAdd = $this->items[$id];
            //เข้าถึง Key Quantity แล้วก็เพิ่มทีละ 1
            $productToAdd['quantity']+=$amount; //เพิ่มจำนวนรายการสินค้า่นั้นๆ
            $productToAdd['totalSinglePrice']=$productToAdd['quantity']*$price; //price เป็นค่าตายตัว
        }
        else{
        //กำหนดค่าเริ่มต้นเก็บข้อมูลภายใน items,totalquantity,totalprice ถ้า id ไม่ซ้ำ
        $productToAdd = ['quantity'=>$amount,'totalSinglePrice'=>$price*$amount,'data'=>$product];
        }

       }
        $this->items[$id]=$productToAdd;
        $this->totalQuantity+=$amount;
        $this->totalPrice= $this->totalPrice + $price; 
        
    }
    //อัพเดทจำนวนสินค้า และ ราคา
    public function updatePriceQuantity(){
        //เป็นตัวแปร local ทำงานในฟังก์ชันนี้อย่างเดียว
        $totalPrice = 0;
        $totalQuantity = 0;
        //จำนวนสินค้าในตะกร้า
        //ราคารวม
        //ดึงราคาแล้ว loop คำนวณ totalQuantity ใหม่
        foreach ($this->items as $item){
            $totalQuantity = $totalQuantity + $item['quantity']; //จำนวนสินค้า เอาของเก่ารวมกับ item ล่าสุด
            $totalPrice = $totalPrice + $item['totalSinglePrice']; //ราคารวมของสินค้าแต่ละรายการ เอาของเก่ารวมกับล่าสุด
        }
        $this -> totalQuantity = $totalQuantity;
        $this -> totalPrice = $totalPrice;

    }
}




?>