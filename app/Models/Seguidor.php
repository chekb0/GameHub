<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seguidor extends Model
{
    use HasFactory;


    protected $table = 'seguidores';

    protected $fillable = ['usuario_seguidor_id', 'usuario_seguido_id'];

    // Relación: Un seguidor pertenece a un usuario (quién sigue a quién).
    public function seguidor()
    {
        // Este modelo indica que el seguidor es un usuario que sigue a otro.
        return $this->belongsTo(User::class, 'usuario_seguidor_id');
    }

    // Relación: Un seguidor sigue a otro usuario.
    public function seguido()
    {
        // El "seguido" es el usuario que es seguido por otro.
        return $this->belongsTo(User::class, 'usuario_seguido_id');
    }
}
