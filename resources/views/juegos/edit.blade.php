@extends('template')

@section('title', 'Editar juego')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="card shadow-lg rounded-4 border-0">
                    <div class="card-header text-center bg-primary text-white p-4">
                        <h3><i class="fas fa-gamepad"></i> Editar juego</h3>
                    </div>
                    <div class="card-body p-5">
                        <form action="{{ route('juegos.update', $juego->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="titulo" class="form-label fw-bold">Título del juego</label>
                                <input type="text" id="titulo" name="titulo" class="form-control form-control-lg" value="{{ old('titulo', $juego->titulo) }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="tipo_juego" class="form-label fw-bold">Tipo de juego</label>
                                <select id="tipo_juego" name="tipo_juego" class="form-control form-control-lg" required>
                                    <option value="">Seleccione un tipo</option>
                                    <option value="Acción" {{ old('tipo_juego', $juego->tipo_juego) == 'Acción' ? 'selected' : '' }}>Acción</option>
                                    <option value="Aventura" {{ old('tipo_juego', $juego->tipo_juego) == 'Aventura' ? 'selected' : '' }}>Aventura</option>
                                    <option value="Deportes" {{ old('tipo_juego', $juego->tipo_juego) == 'Deportes' ? 'selected' : '' }}>Deportes</option>
                                    <option value="Simulacion" {{ old('tipo_juego', $juego->tipo_juego) == 'Simulacion' ? 'selected' : '' }}>Simulación</option>
                                    <option value="Shooter" {{ old('tipo_juego', $juego->tipo_juego) == 'Shooter' ? 'selected' : '' }}>Shooter</option>
                                    <option value="RPG" {{ old('tipo_juego', $juego->tipo_juego) == 'RPG' ? 'selected' : '' }}>RPG</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="descripcion" class="form-label fw-bold">Descripción del juego</label>
                                <textarea id="descripcion" name="descripcion" class="form-control form-control-lg" rows="6">{{ old('descripcion', $juego->descripcion) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="imagen_caratula" class="form-label fw-bold">Enlace a la carátula</label>
                                <input type="text" id="imagen_caratula" name="imagen_caratula" class="form-control form-control-lg" value="{{ old('imagen_caratula', $juego->imagen_caratula) }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="requisitos_sistema" class="form-label fw-bold">Requisitos del sistema</label>
                                <input type="text" id="requisitos_sistema" name="requisitos_sistema" class="form-control form-control-lg" value="{{ old('requisitos_sistema', $juego->requisitos_sistema) }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="archivo" class="form-label fw-bold">Juego en zip o rar</label>
                                <input type="file" id="archivo" name="archivo" class="form-control form-control-lg">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg w-100">
                                    <i class="fas fa-upload"></i> Editar juego
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
