<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingCartsTable extends Migration
{
    public function up()
    {
       Schema::create('shopping_carts', function(Blueprint $table){
           $table->engine = 'InnoDB';
           $table->increments('id');
           
           $table->string('status');
           
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
        Schema::drop('shopping_carts');
    }
}
