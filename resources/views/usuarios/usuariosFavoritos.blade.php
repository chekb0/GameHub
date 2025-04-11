@extends('template')

@section('title', 'Usuarios que sigo')

@section('content')
<div class="container mt-5">
    <!-- Título centrado con descripción -->
    <div class="d-flex justify-content-center mb-4">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card shadow-lg rounded-4">
                <div class="card-body text-center">
                    <h1 class="card-title"><i class="fas fa-heart text-danger"></i> Usuarios que sigo</h1>
                    <p class="card-text">Explora los perfiles de los usuarios que sigues en GameHub</p>
                </div>
            </div>
        </div>
    </div>


    @if($usuarios->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            ¡No sigues a ningún usuario! Agrega algunos a tu lista para verlos aquí.
        </div>
    @else
        <div class="row">
            @foreach($usuarios as $favorito)
                <div class="col-md-4">
                    <!-- Tarjeta personalizada -->
                    <div class="card shadow-lg rounded-4 border-0 mb-4" style="min-height: 500px;">
                        <div class="card-body text-center">
                            <!-- Imagen de avatar del usuario -->
                            <img src="{{ $favorito->seguido->avatar }}" class="card-img-top rounded-top" style="max-width: 100%; height: 250px; object-fit: contain;" alt="{{ $favorito->seguido->login }}">

                            <!-- Nombre del usuario -->
                            <h5 class="card-title fw-bold mt-3">{{ $favorito->seguido->login }}</h5>
                            <p class="text-muted">Usuario activo en GameHub</p>

                            <!-- Botón con animación -->
                            <a href="{{ route('usuarios.show', $favorito->seguido->id) }}" class="btn btn-lg btn-outline-light game-card-btn">
                                <i class="fas fa-user"></i> Ver perfil
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
