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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->text('contenido'); // Texto del comentario que hace el usuario
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade'); // Usuario que comenta
            $table->foreignId('juego_id')->constrained('juegos')->onDelete('cascade'); // Juego comentado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
