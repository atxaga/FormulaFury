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
        Schema::create('lasterketa_taldea', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('taldea');
            $table->unsignedBigInteger('gp');
            $table->tinyInteger('pos_qualy')->nullable();
            $table->tinyInteger('pos_race')->nullable();
            $table->string('buelta_azkarra')->default("ez");
            $table->string('pole')->default("ez");
            $table->timestamps();
        
            $table->foreign('taldea')->references('id')->on('taldeak')->onDelete('cascade');
            $table->foreign('gp')->references('id')->on('grand_prix')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lasterketa_taldea');
    }
};
