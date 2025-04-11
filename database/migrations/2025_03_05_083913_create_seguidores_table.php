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
        Schema::create('seguidores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_seguidor_id')->references('id')->on('users')->onDelete('cascade'); // clave ajena vinculamos el campo usuario_seguidor_id con el campo id de la tabla usuarios
            $table->foreignId('usuario_seguido_id')->references('id')->on('users')->onDelete('cascade');// clave ajena vinculamos el campo usuario_seguido_id con el campo id de la tabla usuarios
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguidores');
    }
};
