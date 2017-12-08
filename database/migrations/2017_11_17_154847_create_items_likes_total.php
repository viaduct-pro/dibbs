<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsLikesTotal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_likes_total', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_id');
            $table->integer('total_like');
            $table->integer('total_dislike');
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
        Schema::drop('item_likes_total', function (Blueprint $table) {
            //
        });
    }
}
