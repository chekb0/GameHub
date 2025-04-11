@extends('template')

@section('title', 'Juegos de ' . $usuario->login)

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4"><i class="fas fa-gamepad"></i> Juegos subidos por {{ $usuario->login }}</h1>

    <!-- Mostrar el total de juegos subidos -->
    <div class="text-center mb-4">
        <strong>Total de juegos subidos: </strong>
        <span>{{ $juegos->count() }}</span>
    </div>

    @if($juegos->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            <strong>¡{{ $usuario->login }} aún no ha subido juegos!</strong>
        </div>
    @else
        <div class="row">
            @foreach($juegos as $juego)
                <div class="col-md-4">
                    <div class="card shadow-lg rounded-4 border-0 mb-4" style="min-height: 420px;">
                        <img src="{{ $juego->imagen_caratula }}" class="card-img-top rounded-top-4"
                             style="max-width: 100%; height: 250px; object-fit: contain;"
                             alt="{{ $juego->titulo }}">

                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">{{ $juego->titulo }}</h5>
                            <p class="text-muted">{{ Str::limit($juego->descripcion, 80) }}</p>
                            <a href="{{ route('juegos.show', $juego->id) }}" class="btn btn-primary w-100">
                                <i class="fas fa-info-circle"></i> Ver Detalles
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
