<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreenImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screen_images', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('screen_id')->unsigned()->nullable();
            $table->integer('image_id')->unsigned()->nullable();
            $table->foreign('screen_id')->on('screens')->references('id')->onDelete('cascade');
            $table->foreign('image_id')->on('images')->references('id')->onDelete('cascade');

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
        Schema::dropIfExists('screen_images');
    }
}
