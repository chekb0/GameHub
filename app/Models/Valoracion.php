<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Valoracion extends Model
{

    use HasFactory;

    protected $table = 'valoraciones';

    protected $fillable = ['usuario_id', 'juego_id', 'puntuacion'];
    // Relación: Una valoración pertenece a un juego.
    public function juego()
    {
        // Una valoración está asociada con un juego específico.
        return $this->belongsTo(Juego::class, 'juego_id');
    }

    // Relación: Una valoración pertenece a un usuario.
    public function usuario()
    {
        // Una valoración fue realizada por un usuario específico.
        return $this->belongsTo(User::class, 'usuario_id');
    }

}
