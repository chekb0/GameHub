<?php

use App\Http\Controllers\JuegoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValoracionController;
use App\Http\Controllers\FavoritoController;


use Illuminate\Support\Facades\Route;


Route::get('/', [JuegoController::class, 'home'])->name('home');
Route::resource('juegos', JuegoController::class);
Route::resource('usuarios', UserController::class);
Route::get('login', [UserController::class, 'loginForm'])->name('login');
Route::post('login', [UserController::class, 'login']);//hacer el login
Route::get('logout', [UserController::class, 'logout'])->name('logout'); //hacer el logout
Route::get('create-user', [UserController::class, 'createUser']); //crear usuario prueba
Route::post('/register', [UserController::class, 'register'])->name('register');//registro de usuario

Route::get('/perfil', [UserController::class, 'perfil'])->name('perfil');
Route::put('/perfil', [UserController::class, 'actualizarAvatar'])->name('perfil.update');



Route::get('/info', function () {
    return view('infoWeb');
})->name('infoWeb'); // para ver la informacion de la pagina web


// routes/web.php
//Route::get('/mis-juegos', [JuegoController::class, 'show'])->name('juegos.show'); // puede que lo quitemos
Route::get('/mis-juegos', [JuegoController::class, 'misJuegos'])->name('mis-juegos'); //para acceder a los juegos subidos por un usuario
Route::get('/juegos/{juego}', [JuegoController::class, 'show'])->name('juegos.show'); //para mostrar los juegos que eliga
Route::post('juegos/{juego}/download', [JuegoController::class, 'download'])->name('juegos.download');//para descargar el juego
Route::post('/valoraciones', [ValoracionController::class, 'store'])->name('valoraciones.store');//para valorar los juegos
// Rutas para manejar favoritos
//Route::post('/favoritos/{juego}', [FavoritoController::class, 'toggle'])->name('favoritos.toggle');
Route::post('/favoritos/juegosFavoritos/{juego_id}', [FavoritoController::class, 'juegosFavoritos'])->name('favoritos.juegosFavoritos');
Route::get('/juegos-favoritos', [JuegoController::class, 'juegosFavoritos'])->name('juegos-favoritos'); //para acceder a los juegos favoritos de un usuario

Route::post('/favoritos/usuarios/{usuario_id}', [FavoritoController::class, 'favoritosUsuarios'])->name('favoritos.usuariosFavoritos'); // sin estar registrado desde el navbar en usuarios registrados, cuando le damos a mas detalles para acceder a un usuario y ver sus juegos subidos

Route::get('/usuarios/{id}/juegos', [UserController::class, 'show'])->name('usuarios.juegos'); // ruta para ver los juegos que ha subido cada usuario desde la vista de usuarios

Route::get('/usarios-favoritos', [UserController::class, 'usuariosFavoritos'])->name('usuarios-favoritos'); //para acceder a los juegos favoritos de un usuario

Route::post('/comentarios', [JuegoController::class, 'store2'])->name('comentarios.store'); //ruta para comentarios











