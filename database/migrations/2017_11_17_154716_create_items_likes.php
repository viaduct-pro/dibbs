<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_likes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('item_id');
            $table->integer('i_id')->nullable();
            $table->string('vote');
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
        Schema::drop('item_likes', function (Blueprint $table) {
            //
        });
    }
}
