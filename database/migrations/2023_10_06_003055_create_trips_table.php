<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->integer('car_id');
            $table->integer('drive_id')->comment('tài xế');
            $table->integer('assistantCar_id')->comment('phụ xế');
            $table->dateTime('start_date')->comment('ngày đi');
            $table->time('start_time');
            $table->string('start_location');
            $table->text('status');
            $table->integer('trip_price')->comment('giá chuyến đi');
            $table->string('end_location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
