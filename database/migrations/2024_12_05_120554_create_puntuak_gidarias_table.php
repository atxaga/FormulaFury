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
        Schema::create('puntuak_gidaria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gidaria');
            $table->integer('puntuak_guztira');
            $table->unsignedBigInteger('gp');
            $table->integer('pos_qualy');
            $table->integer('pos_race');
            $table->boolean('h2h_qualy');
            $table->boolean('h2h_race');
            $table->boolean('buelta_azkarra');
            $table->boolean('pole');
            $table->integer('pos_txapelketa');
            $table->timestamps();

            $table->foreign('gp')->references('id')->on('grand_prix_puntuak')->onDelete('cascade');
            $table->foreign('gidaria')->references('id')->on('gidariak')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puntuak_gidaria');
    }
};
