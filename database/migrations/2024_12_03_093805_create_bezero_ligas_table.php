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
        Schema::create('bezero_liga', function (Blueprint $table) {
            $table->id();
            $table->integer('puntuak');
            $table->foreignId('bezero_id')->references('id')->on('bezeroak')->onDelete('cascade');
            $table->foreignId('liga_id')->references('id')->on('ligak')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bezero_liga');
    }
};
