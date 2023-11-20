<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('type_cars', function (Blueprint $table) {
            $table->integer('type_seats');
        });
    }

    public function down()
    {
        Schema::table('type_cars', function (Blueprint $table) {
            $table->dropColumn('type_seats');
        });
    }
};
