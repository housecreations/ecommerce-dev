<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('article_information_id')->unsigned();
            $table->foreign('article_information_id')->references('id')->on('articles_information')->onDelete('cascade');
            $table->integer('stock');
            $table->integer('discount');
            $table->double('price', 10, 2);
            $table->double('price_now', 10, 2);
            $table->enum('on_discount', ['yes', 'no'])->default('no');
            $table->enum('visible', ['yes', 'no'])->default('yes');
            $table->enum('featured', ['yes', 'no'])->default('no');
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
        Schema::drop('articles');
    }
}
