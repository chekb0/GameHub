@extends('template')

@section('title', 'Mis Juegos Favoritos')

@section('content')
<div class="container mt-5">
    <!-- Título centrado -->
    <!-- Card para el título de bienvenida y descripción -->
    <div class="row justify-content-center mb-4">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card shadow-lg rounded-4">
                <div class="card-body text-center">
                    <h1 class="card-title"><i class="fas fa-heart text-danger"></i> Mis juegos favoritos</h1>
                    <p class="card-text">Descubre tus juegos favoritos guardados en GameHub</p>
                </div>
            </div>
        </div>
    </div>

    @if($juegos->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            ¡No tienes juegos favoritos! Agrega algunos a tu lista para verlos aquí.
        </div>
    @else
        <!-- Contenedor de juegos con fondo interactivo -->
        <div class="row">
            @foreach($juegos as $favorito)
                <div class="col-md-4">
                    <!-- Tarjeta personalizada con animación -->
                    <div class="card shadow-lg rounded-4 border-0 mb-4" style="min-height: 500px;">
                        <div class="card-body text-center">
                            <!-- Imagen de la carátula -->
                            <img src="{{ $favorito->juego->imagen_caratula }}" class="card-img-top rounded-top" style="max-width: 100%; height: 250px; object-fit: contain;" alt="{{ $favorito->juego->titulo }}">
                            <h5 class="card-title fw-bold mt-3">{{ $favorito->juego->titulo }}</h5>
                            <p class="text-muted">{{ Str::limit($favorito->juego->descripcion, 80) }}</p>

                            <!-- Botón con animación -->
                            <a href="{{ route('juegos.show', $favorito->juego->id) }}" class="btn btn-lg btn-outline-light game-card-btn">
                                <i class="fas fa-arrow-right"></i> Ver detalles
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection


