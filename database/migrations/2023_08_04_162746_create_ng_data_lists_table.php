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
        Schema::create('ng_data_lists', function (Blueprint $table) {
            $table->id();
            $table->string('no_do', 20)->references('no_do')->on('do')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('qualityloss_id')->references('id')->on('quality_losses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->double('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ng_data_lists');
    }
};
