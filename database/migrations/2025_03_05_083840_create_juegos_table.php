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
        Schema::create('juegos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo'); // Nombre juego
            $table->text('descripcion'); // Descripción
            $table->string('imagen_caratula'); // URL de la caratula
            $table->string('tipo_juego'); // Tipo de joc (ej: Aventura, Acción)
            $table->text('requisitos_sistema'); // Requisitos mínimos del pc
            $table->string('archivo'); // Ruta del archivo ZIP/RAR
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade'); //cada juego pertenece a un usuario y si el usuario se elimina, sus juegos también se eliminarán.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juegos');
    }
};
