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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('start_location');
            $table->string('end_location');
            $table->time('start_time');
            $table->time('interval_trip');
            $table->string('driver_id')->nullable();
            $table->string('assistantCar_id')->nullable();
            $table->string('car_id')->nullable();
            $table->integer('trip_price');
            $table->integer('status');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
