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
        Schema::create('puntuak_taldea', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('taldea');
            $table->integer('puntuak_guztira');
            $table->unsignedBigInteger('gp');
            $table->string('pos_qualy');
            $table->string('pos_race');
            $table->boolean('buelta_azkarra');
            $table->boolean('pole');
            $table->string('pos_txapelketa');
            $table->timestamps();

            $table->foreign('gp')->references('id')->on('grand_prix_puntuak')->onDelete('cascade');
            $table->foreign('taldea')->references('id')->on('taldeak')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puntuak_taldea');
    }
};
