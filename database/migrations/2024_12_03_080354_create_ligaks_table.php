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
        Schema::create('ligak', function (Blueprint $table) {
            $table->id();
            $table->string('izena');
            $table->string('kodea');
            $table->string('deskribapena')->nullable();
            $table->boolean('klausulak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::disableForeignKeyConstraints();
       Schema::dropIfExists('ligak'); 
       Schema::enableForeignKeyConstraints();
       
    }
};
