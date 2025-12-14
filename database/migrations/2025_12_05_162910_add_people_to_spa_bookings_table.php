<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('spa_bookings', function (Blueprint $table) {
            $table->integer('people')->default(1)->after('date');
        });
    }

    public function down()
    {
        Schema::table('spa_bookings', function (Blueprint $table) {
            $table->dropColumn('people');
        });
    }
};
