<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('deviceId')->nullable();
            $table->string('tenantId')->nullable();
            $table->string('customerId')->nullable();
            $table->string('credentialsType')->nullable();
            $table->string('credentialsId')->nullable();
            $table->string('name');
            $table->string('screenId')->nullable();
            $table->boolean('available')->default(true);
            $table->boolean("availableScreen")->default(true);
            $table->string('type');
            $table->string('label')->nullable();
            $table->boolean('gateway')->nullable()->default(false);
            $table->string('assetId')->nullable();
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
        Schema::dropIfExists('devices');
    }
}
