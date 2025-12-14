<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ferry_ids', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // FID0001
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ferry_ids');
    }
};
