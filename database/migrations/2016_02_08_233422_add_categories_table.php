<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('image_url');
            $table->enum('gender', ['male', 'female', 'no_gender']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations 
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
    }
}
