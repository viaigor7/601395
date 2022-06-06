<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_drivers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id');
            $table->unsignedBigInteger('driver_id');
            $table->index('car_id', 'car_driver_car_idx');
            $table->index('driver_id', 'car_driver_driver_idx');
            $table->softDeletes();

            $table->foreign('car_id', 'car_driver_car_fk')->on('cars')->references('id')->cascadeOnDelete();
            $table->foreign('driver_id', 'car_driver_driver_fk')->on('drivers')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_drivers');
    }
}
