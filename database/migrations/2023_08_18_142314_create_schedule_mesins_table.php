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
        Schema::create('schedule_mesins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mesin_id')->references('id')->on('mesin')->cascadeOnUpdate()->cascadeOnDelete();
            $table->dateTime('start');
            $table->dateTime('stop');
            $table->text('desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_mesins');
    }
};
