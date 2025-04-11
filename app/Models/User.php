<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $table = 'users';

    protected $fillable = ['login', 'email', 'password', 'avatar'];


    // Relación: Un usuario puede tener muchos juegos.
    public function juegos()
    {
        // Definimos que un usuario puede tener muchos juegos relacionados.
        return $this->hasMany(Juego::class, 'usuario_id');
    }

    // Relación: Un usuario puede tener muchos comentarios.
    public function comentarios()
    {
        // Un usuario puede escribir varios comentarios en diferentes juegos.
        return $this->hasMany(Comentario::class, 'usuario_id');
    }

    // Relación: Un usuario puede tener muchas valoraciones.
    public function valoraciones()
    {
        // Un usuario puede valorar varios juegos.
        return $this->hasMany(Valoracion::class, 'usuario_id');
    }

    // Relación: Un usuario puede seguir a otros usuarios.
    public function seguidores()
    {
        // Un usuario puede seguir a otros usuarios (relación "seguidor").
        //return $this->hasMany(Seguidor::class, 'usuario_id');
        return $this->hasMany(Seguidor::class, 'usuario_seguidor_id');

    }

        /**
     * Relación: un usuario puede marcar varios juegos como favoritos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // Relación: Un usuario puede tener muchos juegos favoritos.
    public function favoritos()
    {
        // Un usuario puede marcar varios juegos como favoritos.
        return $this->hasMany(Favorito::class, 'usuario_id');
        //return $this->belongsTo(Favorito::class, 'usuario_id');


    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
