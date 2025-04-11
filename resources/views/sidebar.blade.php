<div class="sidebar">
<a class="navbar-brand" href="{{ route('home') }}">
  <img src="{{ asset('images/Imagen2.png') }}" alt="Logo de GAMEHUB" style="height: 80px; margin-left: 45px;">
</a>

    <hr>

    @if (Auth::check()) <!-- Comprobamos si el usuario está autenticado -->
        <!-- Menú de navegación para usuarios autenticados -->
        <div id="user-menu">
            <h5>Bienvenido, {{ Auth::user()->login }}</h5>
            <ul class="list-unstyled">
                <li><a href="{{ route('home') }}">Inicio</a></li>
                <li><a href="{{ route('perfil') }}">Mi perfil</a></li>
                <li><a href="{{ route('juegos.create') }}">Publicar juego</a></li>
                <li><a href="{{ route('mis-juegos') }}">Juegos que he subido</a></li>
                <li><a href="{{ route('juegos-favoritos') }}">Juegos favoritos</a></li>
                <li><a href="{{ route('usuarios-favoritos') }}">Usuarios que sigo</a></li>
                <li><a href="{{ route('logout') }}">Cerrar sesión</a></li>
            </ul>
        </div>
    @else
        <!-- Formulario de inicio de sesión -->
        <div id="login-form">
            <h5>Iniciar Sesión</h5>
            <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <!-- Verificar si hay error en la sesión -->
            @if(session('error'))
                <div class="alert alert-danger">
                {{ session('error') }}
                </div>
            @endif
            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        </form>
            <hr>
            <p class="text-center">¿Aún no estás registrado?
                <a href="#" id="show-register">Regístrate</a>
            </p>
        </div>

        <!-- Formulario de registro (inicialmente oculto) -->
        <<div id="register-form" style="display: none;">
        <h5>Registro</h5>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" class="form-control" name="login" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Registrarse</button>
        </form>
        <hr>
        <p class="text-center">¿Ya tienes una cuenta?
            <a href="#" id="show-login">Inicia sesión</a>
        </p>
        </div>

    @endif
</div>

<!-- Script para alternar entre login y registro -->
<script>
    document.getElementById('show-register').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('login-form').style.display = 'none';
        document.getElementById('register-form').style.display = 'block';
    });

    document.getElementById('show-login').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('register-form').style.display = 'none';
        document.getElementById('login-form').style.display = 'block';
    });
</script>

