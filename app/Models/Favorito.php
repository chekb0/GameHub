<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorito extends Model
{
    use HasFactory;

    protected $table = 'favoritos';
    protected $fillable = ['usuario_id', 'juego_id'];

    // Relación: Un favorito pertenece a un juego.
    public function juego()
    {
        return $this->belongsTo(Juego::class, 'juego_id');
    }

    // Relación: Un favorito pertenece a un usuario.
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
