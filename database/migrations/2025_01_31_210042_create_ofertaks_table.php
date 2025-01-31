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
        Schema::create('ofertak', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('liga_id');
            $table->unsignedBigInteger('bezeroa_manda');
            $table->unsignedBigInteger('bezeroa_recibe');
            $table->unsignedBigInteger('gidaria_id');
            $table->integer('oferta');
            $table->timestamps();

            $table->foreign('liga_id')->references('id')->on('ligak')->onDelete('cascade');
            $table->foreign('bezeroa_manda')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bezeroa_recibe')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('gidaria_id')->references('id')->on('gidariak')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ofertak');
    }
};
