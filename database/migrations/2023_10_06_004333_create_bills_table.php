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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->integer('discount_code_id');
            $table->string('seat_id');
            $table->integer('trip_id');
            $table->integer('user_id')->comment('khách đặt');
            $table->integer('status_pay');
            $table->integer('total_money');
            $table->integer('total_money_after_discount');
            $table->integer('type_pay');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
