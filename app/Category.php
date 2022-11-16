<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //ใช้ในการเข้าถึงอีก Model
    public function products(){
        //1 หมวดหมู่สินค้า มีสินค้าได้หลายชนิด
        return $this->hasMany(Product::class);
    }
}
