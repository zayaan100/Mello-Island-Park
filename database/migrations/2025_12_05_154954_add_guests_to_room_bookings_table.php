<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGuestsToRoomBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('room_bookings', function (Blueprint $table) {
            $table->integer('guests')->default(1)->after('check_out');
        });
    }

    public function down()
    {
        Schema::table('room_bookings', function (Blueprint $table) {
            $table->dropColumn('guests');
        });
    }
}
