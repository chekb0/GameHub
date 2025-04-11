<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .sidebar {
            height: 100vh;
            width: 220px;
            background-color: #343a40;
            color: white;
            padding: 20px;
            position: fixed;
        }
        .content {
            margin-left: 320px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- barra de navegación -->
    @include('nav')

    <div class="d-flex">
        <!-- Barra lateral -->
        @include('sidebar')

        <!-- Contenido principal -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    <!--footer -->
    <footer class="d-flex flex-wrap justify-content-end align-items-center py-2 border-top px-3">
        <div class="col-md-4 d-flex align-items-center justify-content-end">
            <a href="https://gamehub.com/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                <img src="{{ asset('images/Imagen2.png') }}" width="40" alt="">
            </a>
            <span class="mb-3 mb-md-0 text-muted">Creado por <a href="https://gamehub.com/" target="_blank" class="text-decoration-none text-muted">Iván Hernández</a> &copy; 2025 Todos los derechos reservados</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3">
                <a class="text-muted" href="https://www.facebook.com/gameHub" target="_blank">
                    <i class="fab fa-facebook-f fs-5"></i> <!-- Icono de Facebook -->
                </a>
            </li>
            <li class="ms-3">
                <a class="text-muted" href="https://www.linkedin.com/showcase/gameHub">
                    <i class="fab fa-linkedin-in fs-5"></i> <!-- Icono de LinkedIn -->
                </a>
            </li>
            <li class="ms-3">
                <a class="text-muted" href="https://www.instagram.com/gameHub/">
                    <i class="fab fa-instagram fs-5"></i> <!-- Icono de Instagram -->
                </a>
            </li>
        </ul>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>