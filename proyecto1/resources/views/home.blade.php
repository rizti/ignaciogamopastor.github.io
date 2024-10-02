<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Uñas, Maquillaje y Peinados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .hero-section {
            background-image: url('{{ asset('imagenes/grandeMenu.jpg') }}'); /* Reemplaza con tu imagen */
            background-size: cover;
            background-position: center;
            color: #fff;
            text-align: center;
            padding: 100px 0;
        }

        .hero-section h1 {
            font-size: 3em;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 1.5em;
            margin-bottom: 30px;
        }

        .hero-section .btn {
            padding: 10px 30px;
            font-size: 1.2em;
        }

        .product-category {
            padding: 60px 0;
        }

        .product-category h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 2.5em;
        }

        .product-category .card {
            border: none;
            transition: transform 0.3s;
        }

        .product-category .card:hover {
            transform: scale(1.05);
        }

        footer {
            background-color: #1a1a1a;
            color: #ffffff;
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>
<body>

@include('menu')

<div class="hero-section">
    <div class="container">
        <h1>Bienvenidos a Wartis</h1>
        <p>Tu tienda favorita de uñas, maquillaje y peinados</p>
        <a href="#productos" class="btn btn-primary">Ver Productos</a>
    </div>
</div>

<div id="productos" class="product-category">
    <div class="container">
        <h2>Nuestras Categorías</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="{{asset('imagenes/uñaMenu.jpg')}}" class="card-img-top" alt="Uñas">
                    <div class="card-body">
                        <h5 class="card-title">Uñas</h5>
                        <p class="card-text">Descubre nuestra amplia variedad de productos para el cuidado y decoración de tus uñas.</p>
                        <a href="{{ route('uñas') }}" class="btn btn-primary">Comprar Uñas</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="{{asset('imagenes/maquillajeMenu.jpg')}}" class="card-img-top" alt="Maquillaje">
                    <div class="card-body">
                        <h5 class="card-title">Maquillaje</h5>
                        <p class="card-text">Explora nuestra colección de maquillaje para realzar tu belleza natural.</p>
                        <!--<a href="{{ route('maquillaje') }}" class="btn btn-primary">Ver Maquillaje</a>-->
                        <button class="btn btn-primary">Ver Maquillaje</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="{{asset('imagenes/peinadoMenu.jpg')}}" class="card-img-top" alt="Peinados">
                    <div class="card-body">
                        <h5 class="card-title">Peinados</h5>
                        <p class="card-text">Encuentra los mejores productos y herramientas para peinados.</p>
                        <!--<a href="{{ route('peinado') }}" class="btn btn-primary">Ver Peinados</a>-->
                        <button class="btn btn-primary">Ver Peinados</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('footer')


</body>
</html

