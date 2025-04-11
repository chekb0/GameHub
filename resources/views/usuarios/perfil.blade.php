@extends('template')

@section('title', 'Mi perfil')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Mi Perfil</h4>
                </div>
                <div class="card-body">
                    <!-- Mostrar mensaje de éxito si existe -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif

                    <!-- Imagen de Perfil -->
                    <div class="text-center mb-4">
                        <h5>Imagen de Perfil</h5>
                        @if($usuario->avatar)
                            <img src="{{ $usuario->avatar }}" class="rounded-circle mb-3" width="120" height="120" alt="Avatar">
                        @else
                            <img src="https://via.placeholder.com/120" class="rounded-circle mb-3" alt="Avatar por defecto">
                        @endif

                        <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <input type="file" name="avatar" class="form-control" accept="image/*">
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-upload"></i> Subir nueva imagen
                            </button>
                        </form>
                    </div>

                    <!-- Seguidores y Siguiendo -->
                    <div class="row mb-4 justify-content-center">
                        <div class="col-md-5">
                            <div class="card p-3 shadow-sm rounded-4">
                                <h6 class="card-title text-muted">Seguidores</h6>
                                <p class="h4 text-primary">{{ $seguidores }}</p>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="card p-3 shadow-sm rounded-4">
                                <h6 class="card-title text-muted">Siguiendo</h6>
                                <p class="h4 text-primary">{{ $siguiendo }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total de juegos subidos -->
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <div class="card p-3 shadow-sm rounded-4">
                                <h6 class="card-title text-muted">Total de juegos subidos</h6>
                                <p class="h4 text-primary">{{ $juegos->count() }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


