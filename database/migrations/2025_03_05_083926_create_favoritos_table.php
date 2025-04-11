<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

     public function up()
     {
         Schema::create('favoritos', function (Blueprint $table) {
             $table->id(); // Mantener ID como clave primaria
             $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
             $table->foreignId('juego_id')->constrained('juegos')->onDelete('cascade');
             $table->timestamps();
         });
     }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favoritos');
    }
};
