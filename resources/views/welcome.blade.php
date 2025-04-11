@extends('template')

@section('title', 'Home Page')

@section('content')
<div class="container mt-5"> <!-- Agrego el margen superior y el contenedor -->

    <!-- Card para el título de bienvenida y descripción -->
    <div class="row justify-content-center mb-4">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card shadow-lg rounded-4">
                <div class="card-body text-center">
                    <h1 class="card-title"><i class="fas fa-gamepad"></i> Bienvenido a GameHub</h1>
                    <p class="card-text">Descubre los mejores juegos free to play</p>
                    <h2 class="card-title">Últimos juegos añadidos a la web</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($juegos as $juego)
            <div class="col-md-4">
                <div class="card shadow-lg rounded-4 border-0 mb-4 d-flex flex-column" style="min-height: 500px;">
                    <div class="card-body d-flex flex-column text-center">
                        <!-- Fecha de publicación -->
                        <h5 class="card-title fw-bold mt-3">Juego publicado el: {{ $juego->created_at }}</h5>
                        <!-- Imagen de la carátula -->
                        <img src="{{ $juego->imagen_caratula }}" class="card-img-top rounded-top" style="max-width: 100%; height: 250px; object-fit: contain;" alt="{{ $juego->titulo }}">
                        <h5 class="card-title fw-bold mt-3">{{ $juego->titulo }}</h5>
                        <p class="text-muted" style="flex-grow: 1;">{{ Str::limit($juego->descripcion, 80) }}</p>
                        <a href="{{ route('juegos.show', $juego->id) }}" class="btn btn-primary w-100 mt-auto">
                            <i class="fas fa-info-circle"></i> Ver Detalles
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center">
        <a href="{{ route('juegos.index') }}" class="btn btn-primary btn-lg mt-3 shadow">Explorar Juegos</a>
    </div>
</div>
@endsection
