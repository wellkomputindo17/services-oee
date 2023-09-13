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
        Schema::create('log_mesins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('realtime_mesin_id')->references('id')->on('real_time_mesins')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('no_do', 20)->references('no_do')->on('do')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('type', ['plan', 'unplan', 'speedloss', 'qualityloss', 'downtime'])->nullable();
            $table->string('created_by', 50)->nullable();
            $table->dateTime('log_time_start')->nullable();
            $table->dateTime('log_time_stop')->nullable();
            $table->string('desc_type')->nullable();
            $table->string('reason_desc')->nullable();
            $table->string('status', 50)->nullable();
            $table->time('duration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_mesins');
    }
};
