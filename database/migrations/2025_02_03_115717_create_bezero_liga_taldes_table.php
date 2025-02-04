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
        Schema::create('bezeroa_liga_taldea', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bezeroa_id');
            $table->unsignedBigInteger('liga_id');
            $table->unsignedBigInteger('taldea_id');
            $table->boolean('aukeratuta')->default(0);
            $table->integer('taldea_clausula');
            $table->timestamps();

            $table->foreign('bezeroa_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('liga_id')->references('id')->on('ligak')->onDelete('cascade');
            $table->foreign('taldea_id')->references('id')->on('taldeak')->onDelete('cascade');

         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bezeroa_liga_taldea');

    }
};
