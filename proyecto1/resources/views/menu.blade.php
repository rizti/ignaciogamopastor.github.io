<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>

  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">Wartis</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('uñas') }}">Uñas</a>
          </li>
          <li class="nav-item">
            <!--<a class="nav-link active" href="{{ route('maquillaje') }}">Maquillaje</a>-->
            <a class="nav-link active">Maquillaje</a>
          </li>
          <li class="nav-item">
           <!-- <a class="nav-link active" href="{{ route('peinado') }}">Peinados</a>-->
           <a class="nav-link active">Peinados</a>
          </li>
        </ul>
  
        <!--BOTON INICIO SESIÓN-->
  
        @auth 
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ asset('imagenes/SinAvatar.jpg')}}" class="rounded-circle" width="30" height="30">
              {{ Auth::user()->Usuario }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="{{ route('carrito') }}">Carrito</a></li>
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item">Cerrar sesión</button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
  
        @else
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('login') }}">Iniciar Sesión</a>
            </li>
          </ul>
        @endauth 
      </div>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>