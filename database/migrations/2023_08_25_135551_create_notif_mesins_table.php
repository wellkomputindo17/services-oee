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
        Schema::create('notif_mesins', function (Blueprint $table) {
            $table->id();
            $table->string('no_do', 20)->references('no_do')->on('do')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('mesin_id')->references('id')->on('mesin')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('do_name', 20)->nullable();
            $table->string('mesin_name', 100)->nullable();
            $table->string('status', 50)->nullable();
            $table->dateTime('time_start')->nullable();
            $table->dateTime('time_stop')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notif_mesins');
    }
};