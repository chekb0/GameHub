@extends('template')

@section('title', 'Lista de Usuarios')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4"><i class="fas fa-users"></i> Lista de Usuarios</h1>
    <div class="row">
        @foreach($usuarios as $usuario)
            <div class="col-md-4">
                <div class="card shadow-lg rounded-4 border-0 mb-4" style="min-height: 420px;">
                    <img src="{{ $usuario->avatar }}" class="card-img-top rounded-top-4" style="max-width: 100%; height: 200px; object-fit: cover;" alt="Avatar de {{ $usuario->login }}">

                    <div class="card-body text-center py-3">
                        <h5 class="card-title fw-bold">
                            <a href="{{ route('usuarios.juegos', $usuario->id) }}" class="text-decoration-none">
                                {{ $usuario->login }}
                            </a>
                        </h5>

                        @if(auth()->check() && auth()->user()->id !== $usuario->id)
                            @php
                                $usuarioAutenticado = auth()->user();
                                $esFavorito = $usuarioAutenticado->seguidores()
                                    ->where('usuario_seguidor_id', $usuarioAutenticado->id)
                                    ->where('usuario_seguido_id', $usuario->id)
                                    ->exists();
                            @endphp

                            <form action="{{ route('favoritos.usuariosFavoritos', $usuario->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link p-0">
                                    <i class="fas fa-user-plus {{ $esFavorito ? 'text-danger' : 'text-secondary' }} fa-3x"></i>
                                </button>
                            </form>

                        @endif

                        <a href="{{ route('usuarios.juegos', $usuario->id) }}" class="btn btn-primary mt-3 w-100">
                            <i class="fas fa-info-circle"></i> Ver Detalles
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

