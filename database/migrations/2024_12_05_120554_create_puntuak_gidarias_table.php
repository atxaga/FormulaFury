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
            $table->unsignedBigInteger('gp');
            $table->integer('pos_qualy')->default(0); 
            $table->integer('pos_race')->default(0);
            $table->integer('h2h_qualy')->default(0);
            $table->integer('h2h_race')->default(0);
            $table->integer('buelta_azkarra')->default(0);
            $table->integer('pole')->default(0);
            $table->integer('sprint')->default(0);
            $table->integer('puntuak_guztira')->default(0);
            $table->timestamps();
        
            $table->foreign('gidaria')->references('id')->on('gidariak')->onDelete('cascade');
            $table->foreign('gp')->references('id')->on('grand_prix')->onDelete('cascade');
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
