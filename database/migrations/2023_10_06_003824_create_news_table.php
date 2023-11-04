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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('admin đăng bài');
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('content');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
    //php của bạn k đặt đc folder là new nên mình sửa lại nhé

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
