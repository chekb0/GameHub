@extends('template')

@section('title', 'Detalles del Juego')

@section('content')
<div class="mt-5"> <!-- Agrego el margen superior -->
    <div class="card shadow-lg rounded-4 border-0">
        <img src="{{ $juego->imagen_caratula }}" class="card-img-top rounded-top-4" style="max-width: 100%; height: 250px; object-fit: contain;"alt="{{ $juego->titulo }}">
        <div class="card-body text-center">
            <h5 class="card-title fw-bold">{{ $juego->titulo }}</h5>
            <p class="text-muted">{{ $juego->descripcion }}</p>
            <p><strong>Requisitos del sistema:</strong> {{ $juego->requisitos_sistema }}</p>
            <p><strong>Tipo de juego:</strong> {{ $juego->tipo_juego }}</p>
            <p><strong>Propietario:</strong> {{ $juego->usuario->login }}</p>
            <p><strong>Subido el:</strong> {{ $juego->created_at }}</p>
            @php $promedioValoracion = number_format($juego->valoraciones->avg('puntuacion') ?? 0, 1); @endphp

            <p><strong>Puntuación:</strong> {{ $promedioValoracion }} / 5</p>

            <div class="d-flex justify-content-center align-items-center">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fas fa-star {{ $i <= floor($promedioValoracion) ? 'text-warning' : 'text-secondary' }}"></i>
                @endfor
            </div>

            @if(session('error')) {{-- Ssms de error si ya ha valorat --}}
                <div class="alert alert-danger">{{ session('error') }}
                </div>
            @endif

            @if(session('success')) {{-- mensaje de ok --}}
                <div class="alert alert-success">{{ session('success') }}
                </div>
            @endif

            @if(auth()->check()) {{-- Solo los usuarios autenticados pueden valorar --}}

            {{-- valoracion con estrellas --}}
            <form action="{{ route('valoraciones.store') }}" method="POST" class="mt-3">
                @csrf

                <input type="hidden" name="juego_id" value="{{ $juego->id }}">

                <label for="puntuacion" class="d-block mb-3"><strong>Valorar juego:</strong></label>

                <div class="rating justify-content-center align-items-center">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}_{{ $juego->id }}" name="puntuacion" value="{{ $i }}" />
                        <label for="star{{ $i }}_{{ $juego->id }}" class="fa fa-star"></label>
                    @endfor
                </div>

                <button type="submit" class="btn btn-success mt-3">Enviar valoración</button>

            </form>

            @endif

            {{-- añadir comentarios --}}

            @if(auth()->check())
                <form action="{{ route('comentarios.store') }}" method="POST" class="w-50 mx-auto">
                    @csrf
                    <input type="hidden" name="juego_id" value="{{ $juego->id }}">

                    <div class="mb-3">
                        <label for="contenido" class="mt-4 fs-3">Deja tu comentario:</label>
                        <textarea class="form-control form-control-sm" id="contenido" name="contenido" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar Comentario</button>
                </form>
            @endif

            {{-- Mostrar comentarios --}}
            <h3 class="mt-4">Comentarios:</h3>

            @if($comentarios->isEmpty())
                <p>No hay comentarios aún. ¡Sé el primero en comentar!</p>
            @else
                <div class="container w-50 mx-auto">
                    <ul class="list-group">
                        @foreach($comentarios as $comentario)
                            <li class="list-group-item text-start">
                                <strong>{{ $comentario->usuario->login }}:</strong> {{ $comentario->contenido }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Mostrar corazón si el usuario está autenticado --}}
            @if(auth()->check())
                @php
                    $usuario = auth()->user();
                    $esFavorito = $usuario->favoritos()->where('juego_id', $juego->id)->exists();
                @endphp

                <form action="{{ route('favoritos.juegosFavoritos', $juego->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link">
                        <i class="fas fa-heart fa-2x {{ $esFavorito ? 'text-danger' : 'text-secondary' }}"></i>
                    </button>
                </form>
            @endif

            <br>

            <a href="{{ asset('storage/' . $juego->archivo) }}"class="btn btn-success" download>
                <i class="fas fa-download"></i> Descargar Juego
            </a>
            <a href="{{ route('juegos.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Volver a la lista
            </a>

        </div>
    </div>
</div>
@endsection

