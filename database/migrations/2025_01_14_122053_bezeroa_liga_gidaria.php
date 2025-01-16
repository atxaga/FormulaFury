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
        Schema::create('bezeroa_liga_gidaria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bezeroa_id');
            $table->unsignedBigInteger('liga_id');
            $table->unsignedBigInteger('gidaria_id');
            $table->unsignedBigInteger('taldea_id');

            $table->foreign('bezeroa_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('liga_id')->references('id')->on('ligak')->onDelete('cascade');
            $table->foreign('gidaria_id')->references('id')->on('gidariak')->onDelete('cascade');
            $table->foreign('taldea_id')->references('id')->on('taldeak')->onDelete('cascade');

         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bezeroa_liga_gidaria');

    }
};
