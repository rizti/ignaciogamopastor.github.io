<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uñas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .dropdown-menu {
            padding: 10px;
        }

        .card {
            margin-bottom: 20px;
            border-color: whitesmoke;
        }

        a.textlink {
            text-decoration: none;
            color: black;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .precioEicono {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        @media (max-width: 1200px) {
            .card {
                margin-left: 10%;
                margin-right: 10%;
            }
        }

        @media (max-width: 992px) {
            .card {
                margin-left: 5%;
                margin-right: 5%;
            }
        }

        @media (max-width: 768px) {
            .card {
                margin-left: 10px;
                margin-right: 10px;
            }
        }
    </style>
</head>
<body>
    @include('menu')

    <h1>¡Descubre nuestras uñas!</h1>

    <div class="content">
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Mostrar Filtros
                    </button>
                    <div class="dropdown-menu p-4" aria-labelledby="dropdownMenuButton">
                        <form method="GET" action="{{ route('filtrar_uñas') }}">
                            <div class="form-group">
                                <label for="precio">Precio:</label>
                                <input type="range" class="form-range" id="precio" name="precio" min="0" max="100" step="1" value="0">
                                <span id="precioSeleccionado">0</span>€
                            </div>
                            <div class="form-group">
                                <label for="categoria">CATEGORÍA:</label>
                                <select name="categoria" class="form-control" id="categoria">
                                    <option value="">Ver Todo</option>
                                    <option value="Permanente">Permanente</option>
                                    <option value="Semipermanente">Semipermanente</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tipo">TIPO:</label>
                                <select name="tipo" class="form-control" id="tipo">
                                    <option value="">Ver Todo</option>
                                    <option value="basicas">Básicas</option>
                                    <option value="diseño">Diseño</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">APLICAR FILTROS</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @foreach($datos as $dato)
                    <div class="col mb-4">
                        <a href="{{ route('detallar_uñas', ['nombre' => $dato->nombre]) }}" class="textlink">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset($dato->imagen) }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $dato->nombre }}</h5>
                                    @auth
                                    <div class="precioEicono">
                                        <p class="card-text">{{ $dato->precio }}€</p>
                                        <img src="{{ asset('imagenes/anadir-al-carrito.png') }}" width="20%">
                                    </div>
                                    @else
                                    <p class="card-text">{{ $dato->precio }}€</p>
                                    @endauth
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>



    <script>
        const precioInput = document.getElementById('precio');
        const precioSeleccionadoSpan = document.getElementById('precioSeleccionado');

        precioInput.addEventListener('input', function() {
            precioSeleccionadoSpan.textContent = this.value;
        });
    </script>

    @include('footer')
</body>
</html>
