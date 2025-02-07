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
        Schema::create('lasterketa_gidaria', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('gidaria');
            $table->unsignedBigInteger('gp');
            $table->integer('pos_qualy')->default(0); 
            $table->integer('pos_race')->default(0);
            $table->string('h2h_qualy')->default("ez");
            $table->string('h2h_race')->default("ez");
            $table->string('buelta_azkarra')->default("ez");
            $table->string('pole')->default("ez");
            $table->integer('sprint')->default(0);
            
            $table->foreign('gidaria')->references('id')->on('gidariak')->onDelete('cascade');
            $table->foreign('gp')->references('id')->on('grand_prix')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lasterketa_gidaria');
    }
};
