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
        Schema::create('ticket_order', function (Blueprint $table) {
            $table->id();
            $table->string('code_ticket');
            $table->integer('bill_id');
            $table->string('code_seat');
            $table->string('pickup_location')->comment('Địa điểm đón');
            $table->string('pay_location')->comment('Địa điểm trả');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_order');
    }
};
