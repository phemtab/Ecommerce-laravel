<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('order_id');
            $table->date('date');
            $table->decimal('price',8,2);
            $table->text('status');
            $table->text('del_date');
            $table->text('fname');
            $table->text('lname');    
            $table->text('address');
            $table->text('phone');
            $table->text('zip');
            $table->text('table');
            $table->text('email');
            $table->integer('user_id'); // เชื่อมกับตาราง users
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
