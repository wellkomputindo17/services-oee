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
        Schema::create('time_down_losses', function (Blueprint $table) {
            $table->id();
            $table->string('no_do', 20)->references('no_do')->on('do')->cascadeOnUpdate()->cascadeOnDelete();
            $table->time('time_start')->nullable();
            $table->time('time_stop')->nullable();
            $table->integer('urutan')->nullable();
            $table->string('status', 50)->nullable();
            $table->foreignId('unplan_downtime_id')->nullable();
            $table->foreignId('plan_downtime_id')->nullable();
            $table->foreignId('speedloss_id')->nullable();
            $table->string('created_by', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_down_losses');
    }
};
