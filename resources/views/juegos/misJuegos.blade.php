@extends('template')

@section('title', 'Lista de video-juegos subidos por mi')

@section('content')
<div class="container mt-5"> <!-- Añadí container para mantener el diseño centrado -->
    <div class="row justify-content-center mb-4">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card shadow-lg rounded-4">
                <div class="card-body text-center">
                    <h1 class="card-title"><i class="fas fa-gamepad text-primary"></i> Lista de Videojuegos que He Subido</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($juegos->isEmpty())
        <p class="text-center">No tienes juegos subidos.</p>
    @else
        <div class="row">
            @foreach($juegos as $juego)
                <div class="col-md-4">
                    <div class="card shadow-lg rounded-4 border-0 mb-4" style="min-height: 420px;">
                        <img src="{{ $juego->imagen_caratula }}" class="card-img-top rounded-top-4" style="max-width: 100%; height: 250px; object-fit: contain;" alt="{{ $juego->titulo }}">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">{{ $juego->titulo }}</h5>
                            <p class="text-muted">{{ Str::limit($juego->descripcion, 80) }}</p>
                            <div class="d-flex flex-column align-items-center">
                                <!-- Botón Editar -->
                                <a href="{{ route('juegos.edit', $juego->id) }}" class="btn btn-warning mb-2 w-auto">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <!-- Botón Eliminar -->
                                <form action="{{ route('juegos.destroy', $juego->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este juego?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-auto">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
