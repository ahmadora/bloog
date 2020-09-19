<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('additional_info')->nullable()->default('null');
            $table->string('address');
            $table->string('name');
//            $table->boolean('above')->default('false');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('country')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('region')->nullable();
            $table->string('search')->nullable();
            $table->string('title')->nullable();
            $table->string('zip')->nullable();
            $table->integer('user_id')->unsigned()->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('tenants');
    }
}
