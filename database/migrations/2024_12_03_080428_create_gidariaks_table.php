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
        Schema::create('gidariak', function (Blueprint $table) {
            $table->id();
            $table->string('izena');
            $table->unsignedBigInteger('taldea');
            $table->unsignedBigInteger('puntuak');
            $table->unsignedBigInteger('jabea')->nullable();
            $table->string('kategoria');
            $table->string("disponibilitatea");
            $table->integer('balioa');
            $table->string('foto');
            
            $table->timestamps();
            $table->foreign('taldea')->references('id')->on('taldeak')->onDelete('cascade');
            $table->foreign('jabea')->references('id')->on('bezeroak')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('gidariak');
        Schema::enableForeignKeyConstraints();

    }
};
