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
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_type_discount_code');
            $table->text('name');
            $table->integer('quantity');
            $table->integer('quantity_used')->default(0); // Default value for quantity used is set to 0
            $table->datetime('start_time');
            $table->integer('value');
            $table->string('code');
            $table->datetime('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_codes');
    }
};
