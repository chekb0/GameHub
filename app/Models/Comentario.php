<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentarios';

    protected $fillable = ['contenido', 'usuario_id', 'juego_id'];
    // Relación: Un comentario pertenece a un juego.
    public function juego()
    {
        // Un comentario está asociado con un juego específico
        return $this->belongsTo(Juego::class, 'juego_id');
    }

    // Relación: Un comentario pertenece a un usuario.
    public function usuario()
    {
        // Un comentario fue escrito por un usuario específico.
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
