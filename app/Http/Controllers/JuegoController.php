<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Juego;
use Illuminate\Support\Facades\Auth;
use App\Models\Comentario;

class JuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function home()
    {
        $juegos = Juego::orderBy('created_at', 'desc')->take(6)->get();
        return view('welcome', compact('juegos'));
    }
   /* public function index()
    {
        $juegos = Juego::all();
        return view("juegos.index",compact("juegos"));
    }*/

    public function index(Request $request)
    {
        $tipo = $request->input('tipo_juego');

        if ($tipo) {
            $juegos = Juego::where('tipo_juego', $tipo)->paginate(2);
        } else {
            $juegos = Juego::paginate(2);
        }

        return view('juegos.index', compact('juegos'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("juegos.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            // Validar los campos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'tipo_juego' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen_caratula' => 'required|url',
            'requisitos_sistema' => 'required|string',
            'archivo' => 'required|file|mimes:zip,rar', // Validar que sea un archivo zip o rar
        ]);

        $juego = new Juego();
        $juego->titulo = $request->get('titulo');
        $juego->tipo_juego = $request->get('tipo_juego');
        $juego->descripcion = $request->get('descripcion');
        $juego->imagen_caratula = $request->get('imagen_caratula');
        $juego->requisitos_sistema = $request->get('requisitos_sistema');

        if ($request->hasFile('archivo') && $request->file('archivo')->isValid()) {
            $archivo = $request->file('archivo');
            $path = $archivo->storeAs('juegos', $archivo->getClientOriginalName(), 'public'); // Guarda el archivo en el directorio 'storage/app/public/juegos'
            $juego->archivo = $path; // Guarda la ruta del archivo en la base de datos
        } else {
            return back()->with('error', 'Archivo no válido');
        }


        $juego->usuario_id = Auth::id(); // Asocia el juego con el usuario autenticado

        $juego->save();

        // Redirige a la lista de juegos
        return redirect()->route('mis-juegos' )->with('success', 'Juego subido correctamente');

    }

    //para añadir comentarios en la base de datos
    public function store2(Request $request)
    {
    $request->validate([
        'contenido' => 'required|string|max:1000',
        'juego_id' => 'required|exists:juegos,id',
    ]);

    // Crear una nueva instancia de Comentario
    $comentario = new Comentario();

    // Asignar los valores a las propiedades del modelo
    $comentario->contenido = $request->get('contenido');
    $comentario->usuario_id = auth()->user()->id;
    $comentario->juego_id = $request->get('juego_id');

    // Guardar el comentario
    $comentario->save();

    return back()->with('success', 'Comentario añadido correctamente.');

    }



    /**
     * Display the specified resource.
     */
    //public function show(string $id)
    public function show(Juego $juego)

    {
        // Obtener los comentarios del juego nuevo
        $comentarios = $juego->comentarios()->with('usuario')->get();


        // Pasar los juegos a la vista
        return view('juegos.show', compact('juego', 'comentarios'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(juego $juego)
    {

        // Pasar los juegos a la vista
        return view('juegos.edit', compact('juego'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Juego $juego)
    {
        // Validar los campos antes de hacer la actualización
        $request->validate([
            'titulo' => 'required|string|max:255',
            'tipo_juego' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen_caratula' => 'required|url',
            'requisitos_sistema' => 'required|string',
            'archivo' => 'nullable|file|mimes:zip,rar', // El archivo es opcional
        ]);

        // Actualizar los campos
        $juego->titulo = $request->get('titulo');
        $juego->tipo_juego = $request->get('tipo_juego');
        $juego->descripcion = $request->get('descripcion');
        $juego->imagen_caratula = $request->get('imagen_caratula');
        $juego->requisitos_sistema = $request->get('requisitos_sistema');

        // Manejar el archivo y guardarlo si es que se sube uno nuevo
        if ($request->hasFile('archivo') && $request->file('archivo')->isValid()) {
            $archivo = $request->file('archivo');
            $path = $archivo->store('juegos'); // Guarda el archivo en el directorio 'juegos'
            $juego->archivo = $path; // Guarda la ruta del archivo en la base de datos
        }

        // asociamos juego con el usuario autenticado
        $juego->usuario_id = Auth::id();

        $juego->save();

        return redirect()->route('mis-juegos')->with('success', 'Juego actualizado correctamente');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Juego $juego)
    {
        $juego->delete();
        return redirect()->route('mis-juegos')->with('success', 'Juego eliminado correctamente');


    }

    public function misJuegos()

    {
        // Obtener el usuario logueado
        $usuario = Auth::user();

        // Obtener los juegos del usuario logueado
        $juegos = $usuario->juegos;  // Esto carga los juegos que están relacionados con el usuario

        // Pasar los juegos a la vista
        return view('juegos.misJuegos', compact('juegos'));
    }

    // JuegoController.php
    public function download(Juego $juego)
    {
        $pathToFile = storage_path('app/public/' . $juego->archivo);

        // Verificar si el archivo existe
        if (file_exists($pathToFile)) {
            return response()->download($pathToFile);
        } else {
            return redirect()->route('juegos.show', $juego->id)
                            ->with('error', 'El archivo no está disponible.');
        }
    }

    public function juegosFavoritos()
    {
        // Obtener el usuario logueado
        $usuario = Auth::user();

        // Obtener los juegos favoritos del usuario logueado
        // Con la relación 'favoritos', podemos obtener los juegos directamente
        $juegos = $usuario->favoritos()->with('juego')->get();

    // Pasar los juegos a la vista
    return view('juegos.juegosFavoritos', compact('juegos'));
    }




}
