<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('images', function (Blueprint $table) {
           $table->engine = 'InnoDB';
           $table->increments('id');
           $table->integer('article_id')->unsigned();
           $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
           $table->string('image_url');
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
        Schema::drop('images');
    }
}
