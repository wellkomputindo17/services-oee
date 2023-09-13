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
        Schema::create('real_time_mesins', function (Blueprint $table) {
            $table->id();
            $table->string('no_do', 20)->references('no_do')->on('do')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('mesin_id')->references('id')->on('mesin')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('line_id')->nullable();
            $table->string('status', 50)->nullable();
            $table->string('operator', 50)->nullable();
            $table->double('target')->nullable();
            $table->double('actual')->nullable();
            $table->double('ng')->nullable();
            $table->string('cycle_time', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_time_mesins');
    }
};
