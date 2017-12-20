<?php
 
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 
class CreateTableCartsItem extends Migration
{
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cart_id');
            $table->integer('variance_id');
            $table->timestamps();
            $table->string('status')->default('valid');
            $table->integer('quantity');
        });
    }
 
    public function down()
    {
        Schema::drop('cart_items');
    }
}
