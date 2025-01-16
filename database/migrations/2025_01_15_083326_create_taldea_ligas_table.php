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
        Schema::create('liga_taldea', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('liga_id');
            $table->unsignedBigInteger('taldea_id');
            $table->boolean('erabilgarritasuna')->default(true);
            $table->integer('erositako_prezioa')->nullable();
            $table->integer('saldutako_prezioa')->nullable();
            $table->timestamps();

            $table->foreign('liga_id')->references('id')->on('ligak')->onDelete('cascade');
            $table->foreign('taldea_id')->references('id')->on('taldeak')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liga_taldea');
    }
};
