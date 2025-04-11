<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid justify-content-center">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white active" aria-current="page" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('juegos.index') }}">Lista de juegos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('usuarios.index') }}">Usuarios registrados</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('infoWeb') }}">Acerca de</a>
        </li>
      </ul>
    </div>
  </div>
</nav>



