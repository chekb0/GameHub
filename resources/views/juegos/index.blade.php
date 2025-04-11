@extends('template')

@section('title', 'Lista de Videojuegos')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4"><i class="fas fa-gamepad"></i> Lista de Videojuegos</h1>
    <div class="row">
    <form method="GET" action="{{ route('juegos.index') }}" class="mb-4">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <select name="tipo_juego" class="form-select form-select-lg">
                <option value="">-- Filtrar por tipo --</option>
                <option value="Accion" {{ request('tipo_juego') == 'Accion' ? 'selected' : '' }}>Acción</option>
                <option value="Aventura" {{ request('tipo_juego') == 'Aventura' ? 'selected' : '' }}>Aventura</option>
                <option value="Deportes" {{ request('tipo_juego') == 'Deportes' ? 'selected' : '' }}>Deportes</option>
                <option value="Simulación" {{ request('tipo_juego') == 'Simulación' ? 'selected' : '' }}>Simulación</option>
                <option value="Shooter" {{ request('tipo_juego') == 'Shooter' ? 'selected' : '' }}>Shooter</option>
                <option value="RPG" {{ request('tipo_juego') == 'RPG' ? 'selected' : '' }}>RPG</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary btn-lg w-100">
                <i class="fas fa-filter"></i> Filtrar
            </button>
        </div>
    </div>
    </form>
        @foreach($juegos as $juego)
            <div class="col-md-4">
                <div class="card shadow-lg rounded-4 border-0 mb-4" style="min-height: 420px;">
                <img src="{{ $juego->imagen_caratula }}" class="card-img-top rounded-top-4" style="max-width: 100%; height: 250px; object-fit: contain;"alt="{{ $juego->titulo }}">
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
        <div class="d-flex justify-content-center mt-4">
    {{ $juegos->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
