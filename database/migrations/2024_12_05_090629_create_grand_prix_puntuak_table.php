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
        Schema::create('grand_prix_puntuak', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gp')->nullable();
            $table->foreignId('bezeroa')->constrained('bezeroak')->onDelete('cascade');
            $table->integer('puntuak_gidaria');
            $table->integer('puntuak_taldea');
            $table->timestamps();

            
            $table->foreign('gp')->references('gp')->on('grand_prix')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grand_prix_puntuak');
    }
};
