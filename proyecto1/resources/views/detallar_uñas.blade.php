@include('menu')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Uña</title>

    <!-- Custom CSS -->
    <style>

        body{
            background-color: #f0f0f0;
        }

        .image-container {
            width: 100%;
            height: 30em; 
            margin-top: 10%;
            overflow: hidden; 
            display: flex;
            justify-content: center;
            align-items: center;    
        }

        .image-container img {
            min-width: 100%; 
            min-height: 100%;   
            height: auto; 
        }

        .details-content {
            padding: 5%; 
            border-radius: 25px;
            margin-top: 10%;
        }

        .details-content p {
            margin-bottom: 2%; /* Reducir el margen inferior */
        }

        .details-content h1 {
            margin-bottom: 4%; 
            text-align: center;
        }

        .precio {
            color: black; 
            font-weight: bold; 
            font-size: 2em;
        }

        .precio-iva-container {
            display: flex;
            align-items: baseline; /* Alinea los elementos al inicio */
        }

        .iva {
            margin-left: 2%;
        }

        .cateYtipo {
            display: flex;
            align-items: baseline; /* Alinea los elementos al inicio */
        }

        .tipo {
            margin-left: 10%;
        }

        .categoria {
            margin-left: 10%;
        }

        .size-buttons {
            margin-top: 5%;
            display: flex;
            justify-content: center;
            gap: 1em;
        }

        .size-button {
            padding: 1% 5%;
            border-radius: 20px;
            border: 2px solid gray;
            background-color: white;
            color: black;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s, color 0.3s;
            font-size: 1em;
        }

        .size-button.selected {
            border-color: black;
            background-color: black;
            color: white;
        }

        .button-container {
            display: flex;
            align-items: center;
            gap:2em;
        }
        .botonComprar{
            background-color: black;
            color: white;
            width: 80%;
            height: 3em;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2em;
            border: none;
            cursor: pointer;
        }

        .informacionEnvioDevolucion{
            background-color: #d9d9d9;
        }
        .contenidoinfocliente{
            padding: 3% 7%;
            color: #2E8B57; 
        }
        .IconoAyuda{
            margin-right:2%;
        }


    .color-buttons {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
}

.color-button {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: inline-block;
    margin: 5px;
    cursor: pointer;
   border:solid;
    transition: border-color 0.3s, transform 0.3s;
}

.color-button.selected {
    border-color: black;
    transform: scale(1.1); /* Pequeña animación para resaltar el botón seleccionado */
}

</style>
</head>


<body>
    <div class="container">
        <div class="row align-items-center">
            <!-- Imagen -->
            <div class="col-md-6">
                <div class="image-container">
                    <img  id="imagen"  src="{{ asset($uña->imagen) }}" alt="Imagen de la uña">
                </div>
            </div>
            <!-- Texto -->
            <div class="col-md-6">
                <div class="details-container">
                    <div class="details-content">
                        <!--NOMBRE UÑA-->
                        <h1>{{ $uña->nombre }}</h1>

                        <!--PRECIO UÑA-->
                        <div class="precio-iva-container">
                            <p class="precio">{{ $uña->precio }}€</p>
                            <p class="iva">IVA Incluido</p>
                        </div>

                        <!--DESCRIPCION UÑA-->
                        <p>{{ $uña->descripcion }}</p>

                        <!--CATEGORIA Y TIPO UÑA-->
                        <div class="cateYtipo">
                            <p class="categoria"><strong style="font-size: 1.2em;">Categoría:</strong> {{ $uña->categoria }}</p>
                            <p class="tipo"><strong style="font-size: 1.2em;">Tipo:</strong> {{ $uña->tipo }}</p>
                        </div>

                        <!--COLOR UÑA-->
                        <p><strong style="font-size: 1.4em;">Color:</strong>
                            @if(isset($coloresBasicos) && $coloresBasicos->isNotEmpty())
                                <div class="color-buttons">
                                    @foreach($coloresBasicos as $colorBasico)
                                        <div class="color-button" style="background-color: rgb({{ $colorBasico->color }}); " >
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>Color mostrado en la imagen.</p>
                            @endif
                        </p>

                        <!--TAMAÑO DE LA UÑA-->
                        <p><strong style="font-size: 1.4em;">Tamaño:</strong></p>
                        <div class="size-buttons">
                            <div class="size-button" data-size="XS">XS</div>
                            <div class="size-button" data-size="S">S</div>
                            <div class="size-button" data-size="M">M</div>
                            <div class="size-button" data-size="L">L</div>
                            <div class="size-button" data-size="XL">XL</div>
                            <div class="size-button" data-size="XXL">XXL</div>
                        </div>
                        </br>

                        <!--BOTON COMPRAR-->
                        @auth
                        <form id="formularioComprar" action="{{ route('detallar_uñas', ['nombre' => $uña->nombre]) }}" method="POST">
                             @csrf
                            <div class="button-container">
                                <input type="hidden" name="nombreUña" value="{{ $uña->nombre }}">
                                <input type="hidden" name="precio" value="{{ $uña->precio }}">
                                <input type="hidden" name="categoria" value="{{ $uña->categoria }}">
                                <input type="hidden" name="tipo" value="{{ $uña->tipo }}">
                                <input type="hidden" name="imagen" value="{{ $uña->imagen }}">
                                <input type="hidden" id="colorSeleccionado" name="color">
                                <input type="hidden" id="tamañoSeleccionado" name="tamaño">

                                <button id="botonComprarProducto" class="botonComprar">Añadir al carrito</button>
                                <span>Hola</span>
                            </div>
                        </form>
                        @else
                            <div class="button-container">
                            <button id="botonSinIniciarSes" class="botonComprar">Añadir al carrito</button>
                            <span>Hola</span>
                        </div>
                        @endauth
                        <br><br>
                    
                    <!--INFOMRACION EXTRA-->
                        <div class="informacionEnvioDevolucion">
                            <div class="contenidoinfocliente">
                                <img src="{{asset('imagenes/camion.png')}}" width="25" height="25" class="IconoAyuda"> <span>Envío Gratuito(Pedidos≥19,00€)</span></br>
                                <img src="{{asset('imagenes/caja-de-devolucion.png')}}" width="25" height="25" class="IconoAyuda"><span>Devoluciones y Rembolso GRATUITA</span></br>
                                <img src="{{asset('imagenes/llamada-telefonica.png')}}" width="25" height="25" class="IconoAyuda"><span>Telefono Ayuda: 610 31 51 02</span></br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br><br><br><br><br>

   



    <!--JS-->
    <script>

        var nombreUña = "{{ $uña->nombre }}";
        var precio = "{{$uña->precio}}";
        var categoria = "{{$uña->categoria}}";
        var tipo = "{{$uña->tipo}}";
        var imagen="{{$uña->imagen}}";

        @auth
            var nombreUsuario = "{{ Auth::user()->Usuario }}";
        @endauth


        //TAMAÑO UÑA
        document.querySelectorAll('.size-button').forEach(button => {
            button.addEventListener('click', function() {
                // Remover la clase 'selected' de todos los botones
                document.querySelectorAll('.size-button').forEach(btn => btn.classList.remove('selected'));
                
                // Agregar la clase 'selected' al botón clicado
                this.classList.add('selected');
            });
        });


      //COLOR UÑA
        document.querySelectorAll('.color-button').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.color-button').forEach(btn => btn.classList.remove('selected'));
                this.classList.add('selected');
            });
        });


        //COMPRAR
        @auth

    document.getElementById('botonComprarProducto').addEventListener('click', function(event) {
        event.preventDefault();

        var colorSeleccionado = document.querySelector('.color-button.selected');
        var tamañoSeleccionado = document.querySelector('.size-button.selected');

        if (colorSeleccionado && tamañoSeleccionado) {
            var tamaño = tamañoSeleccionado.dataset.size;
            var colorRGB = getComputedStyle(colorSeleccionado).backgroundColor;

            
            // Establecer los valores de los inputs ocultos
            document.getElementById('colorSeleccionado').value = colorRGB;
            document.getElementById('tamañoSeleccionado').value = tamaño;

            //AJAX
            // Obtener el token CSRF
            var token = document.querySelector('input[name="_token"]').value;

            // Crear los datos a enviar
            var data = {
                color: colorRGB,
                tamaño: tamaño,
                nombreUña: nombreUña,
                precio: precio,
                categoria: categoria,
                tipo: tipo,
                imagen: imagen,
                _token: token
            };

            // Enviar los datos mediante AJAX
            fetch('{{ route('carrito') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify(data)
            })

            .then(response => {
                // Verificar si la respuesta es JSON
                if (response.headers.get('Content-Type').includes('application/json')) {
                    return response.json();
                } else {
                    throw new Error('La respuesta no es JSON');
                }
            })
            .then(data => {
                if (data.success) {
                    alert('¡Artículo añadido al carrito con éxito!');
                    //window.location.href = '{{ route('home') }}';
                } else {
                    alert('Hubo un problema al añadir el artículo al carrito.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error al procesar la solicitud.');
            });
        } else {
            alert('Por favor, seleccione un color y un tamaño antes de añadir al carrito.');
        }
    });
    @else
    document.getElementById('botonSinIniciarSes').addEventListener('click', function() {
        var baseUrl = window.location.origin;
        var relativePath = '/proyecto1/public/login';
        window.location.href = baseUrl + relativePath;
    });
    @endauth


      

</script>


@include('footer')
</body>


</html>
