<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Seguidor;
use Illuminate\Support\Facades\Hash;




use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all();
        return view("usuarios.index",compact("usuarios"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = User::findOrFail($id);
        $juegos = $usuario->juegos;

        return view('usuarios.show', compact('usuario', 'juegos'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function perfil()
    {
    // Obtener el usuario autenticado
    $usuario = Auth::user();  // Aquí estamos usando el usuario autenticado en lugar de pasar un ID.

    // Obtener los juegos del usuario
    $juegos = $usuario->juegos;

    // Contar cuántos seguidores tiene el usuario (usuario_seguido_id)
    $seguidores = Seguidor::where('usuario_seguido_id', $usuario->id)->count();

    // Contar cuántos usuarios sigue el usuario (usuario_seguidor_id)
    $siguiendo = Seguidor::where('usuario_seguidor_id', $usuario->id)->count();

    // Pasar los datos a la vista
    return view('usuarios.perfil', compact('usuario', 'juegos', 'seguidores', 'siguiendo'));
    }


    public function actualizarAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:2048', // Máx 2MB
        ]);

        $usuario = Auth::user();

        // Guardar imagen en 'public/avatars'
        $ruta = $request->file('avatar')->store('avatars', 'public');

        // Actualizar campo en base de datos
        $usuario->avatar = 'storage/' . $ruta;
        $usuario->save();

        return redirect()->route('perfil')->with('success', '¡Imagen actualizada correctamente!');
    }
    public function usuariosFavoritos()
    {
    // Obtener el usuario logueado
    $usuario = Auth::user();

    // Obtener los usuarios que sigue el usuario logueado
    $usuarios = $usuario->seguidores()->with('seguido')->get();

    // Pasar los usuarios a la vista
    return view('usuarios.usuariosFavoritos', compact('usuarios'));
    }


    public function loginForm()
    {
         return view('auth.login');
    }
    public function login(Request $request)
    {
         $credenciales = $request->only('email', 'password');
         if (Auth::attempt($credenciales))
        {
            return redirect()->intended('/');  // Redirige a la página principal

        }else {
                $error = 'Email o contraseña incorrecta';
                return redirect()->intended('/')->with('error', $error);


        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function createUser()
    {
    $usuario = new User();
    $usuario->login = 'ivanetche';
    $usuario->email = 'ivanetche@gmail.com';
    $usuario->password = bcrypt('12345678'); // Cifra la contraseña
    $usuario->save(); // Guarda el usuario en la base de datos

    return "Usuario creado exitosamente!";
    }

    public function register(Request $request)
    {
        $request->validate([
            'login' => 'required|string|max:255|unique:users,login',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',  // Para confirmar la contraseña
        ]);

        // Crear el usuario
        $user = new User();
        $user->login = $request->input('login');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));  // Encriptar la contraseña
        $user->save();

        // Autenticar al usuario automáticamente
        Auth::login($user);

        return redirect()->route('home');
    }






}
