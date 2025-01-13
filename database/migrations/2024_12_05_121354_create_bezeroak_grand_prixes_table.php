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
        Schema::create('bezeroak_grand_prix', function (Blueprint $table) {
            $table->id();
            $table->string('puntuak');
            $table->foreignId('bezero_id')->references('id')->on('bezeroak');
            $table->foreignId('grand_prix_puntuak_id')->references('id')->on('grand_prix_puntuak');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bezeroak_grand_prix');
    }
};
