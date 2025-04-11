<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Valoracion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ValoracionController extends Controller
{
    public function store(Request $request)
    {
        $usuario = Auth::user();
        $usuarioId = $usuario ? $usuario->id : null;

        $request->validate([
            'juego_id' => 'required|exists:juegos,id',
            'puntuacion' => 'required|integer|min:1|max:5',
        ]);

        // Buscar si el usuario ya valoró el juego
        $valoracionExistente = Valoracion::where('usuario_id', Auth::id())
                                 ->where('juego_id', $request->juego_id)
                                 ->first();


        if ($valoracionExistente) {
            return back()->with('error', 'Ya has valorado este juego.');
        }

        // Guardar nueva valoración
        Valoracion::create([
            'usuario_id' => Auth::id(),
            'juego_id' => $request->juego_id,
            'puntuacion' => $request->puntuacion,
        ]);

        return back()->with('success', 'Valoración guardada con éxito.');
    }
}
