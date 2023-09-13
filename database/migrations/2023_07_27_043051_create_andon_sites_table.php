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
        Schema::create('andon_sites', function (Blueprint $table) {
            $table->id();
            $table->string('production_no', 15)->unique();
            $table->double('kode_page');
            $table->string('nama_line', 100);
            $table->string('nama_mesin', 150);
            $table->string('operator', 150);
            $table->string('part_no', 50);
            $table->double('target');
            $table->double('actual');
            $table->string('cycle_time', 50);
            $table->double('ng');
            $table->string('status', 20);
            $table->time('time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('andon_sites');
    }
};
