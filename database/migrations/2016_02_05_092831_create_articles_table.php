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
            $table->increments('id');
            $table->integer('page_id')->unique();
            $table->string('title');
            $table->string('subtitle');
            $table->longText('body');
            $table->timestamp('pub_date');
            $table->integer('user_id')->unsigned();
            $table->string('img');
            $table->string('video');
            $table->integer('edition_state');
            $table->integer('state');
            $table->string('last_name');
            $table->string('first_name');
            $table->integer('category_id')->unsigned();  
            $table->string('category');
            $table->timestamp('event_begin_date');
            $table->timestamp('event_end_date');
            $table->string('event_location');
            $table->string('news_type');
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
