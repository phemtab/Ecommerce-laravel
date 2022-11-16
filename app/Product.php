<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    public function category(){
        // แต่ละสินค้าจะมีได้หมวดหมู่เดียว เป็นการเข้าถึง Category
        return $this->belongsTo(Category::class);
    }
}
