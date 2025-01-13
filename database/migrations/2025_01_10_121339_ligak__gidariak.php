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
        Schema::create('ligak_gidariak', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('liga');
            $table->unsignedBigInteger('gidaria');
            $table->boolean('erabilgarritasuna')->default(true);
            $table->integer('erositako_prezioa')->nullable();
            $table->integer('saldutako_prezioa')->nullable();
            $table->timestamps();
            $table->foreign('liga')->references('id')->on('ligak')->onDelete('cascade');
            $table->foreign('gidaria')->references('id')->on('gidariak')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligak_gidariak');

    }
};
