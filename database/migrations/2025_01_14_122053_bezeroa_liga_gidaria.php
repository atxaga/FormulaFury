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
            $table->unsignedInteger('bezeroa_id');
            $table->unsignedBigInteger('liga_id');
            $table->unsignedBigInteger('gidaria_id');
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
