<?php

namespace App\Models;

use Faker\Provider\UserAgent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Juego extends Model
{
    use HasFactory;

    protected $table = 'juegos';
    protected $fillable = ['titulo', 'descripcion', 'imagen_caratula', 'tipo_juego', 'requisitos_sistema', 'archivo', 'usuario_id'];

    // Relación: Un juego puede tener muchos comentarios.
    public function comentarios()
    {
        // Un juego puede recibir varios comentarios de los usuarios.
        return $this->hasMany(Comentario::class, 'juego_id');
    }

    // Relación: Un juego puede tener muchas valoraciones.
    public function valoraciones()
    {
        // Un juego puede ser valorado varias veces por los usuarios.
        return $this->hasMany(Valoracion::class, 'juego_id');
    }

    // Relación: Un juego puede ser marcado como favorito por muchos usuarios.
    public function favoritos()
    {
        // Un juego puede ser agregado a los favoritos por varios usuarios.
        return $this->hasMany(Favorito::class, 'juego_id');
    }

    // Relación: Un juego pertenece a un usuario.
    public function usuario()
    {
        // Un juego tiene un único propietario (el usuario que lo sube).
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
