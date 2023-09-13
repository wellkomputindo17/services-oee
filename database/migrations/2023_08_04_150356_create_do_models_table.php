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
        Schema::create('do', function (Blueprint $table) {
            $table->id();
            $table->string('no_do', 20)->unique();
            $table->string('name', 150);
            $table->string('type', 50)->nullable();
            $table->double('target')->nullable();
            $table->double('actual')->nullable();
            $table->double('ng')->nullable();
            $table->string('create_by', 50)->nullable();
            $table->string('operator', 50)->nullable();
            $table->string('pic_produksi', 50)->nullable();
            $table->dateTime('time_start')->nullable();
            $table->dateTime('time_stop')->nullable();
            $table->dateTime('log_time_start')->nullable();
            $table->dateTime('log_time_stop')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('do');
    }
};
