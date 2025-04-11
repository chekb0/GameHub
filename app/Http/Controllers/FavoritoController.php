<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;



class FavoritoController extends Controller
{
    public function juegosFavoritos($juego_id)
    {
        // Obtener al usuario autenticado.

        $usuario = Auth::user();
        //dd($usuario->favoritos);  // Verificar si la relación favoritos devuelve algo.

        // Verificar si el juego ya está en los favoritos del usuario
        $favorito = $usuario->favoritos()->where('juego_id', $juego_id)->first();

        if ($favorito) {
            // Si el juego ya está en favoritos, eliminarlo
            $favorito->delete();
        } else {
            // Si el juego no está en favoritos, agregarlo
            $usuario->favoritos()->create([
                'juego_id' => $juego_id
            ]);
        }

        // Redirigir al usuario de vueltaf
        return back();
    }

    public function favoritosUsuarios($usuario_id)
    {
        // Obtener al usuario autenticado
        $usuario = Auth::user();

        // Verificar si el usuario ya está en los favoritos del usuario autenticado
        $favorito = $usuario->seguidores()->where('usuario_seguido_id', $usuario_id)->first();

        if ($favorito) {
            // Si ya está como favorito, eliminarlo
            $favorito->delete();
        } else {
            // Si no está como favorito, agregarlo
            $usuario->seguidores()->create([
                'usuario_seguidor_id' => $usuario->id,  // El usuario que está haciendo la acción
                'usuario_seguido_id' => $usuario_id,    // El usuario que se va a agregar como favorito
            ]);
        }

        return back();
    }


}
