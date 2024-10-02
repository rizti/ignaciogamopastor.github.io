<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        footer {
            display: flex;
            flex-wrap: wrap; /* Permite que los elementos se envuelvan en dispositivos pequeños */
            justify-content: center;
            text-align: center; /* Alinea el texto al centro */
            background-color: #1a1a1a;
            color: #ffffff;
            padding: 20px 0; /* Reduce el relleno para dispositivos pequeños */
        }

        .footer-section {
            flex: 1; /* Ocupa el mismo espacio horizontalmente */
            margin-bottom: 20px; /* Espacio entre las secciones del footer */
        }

        .footer-links a {
            color: #ffffff;
            text-decoration: none;
            display: block; /* Convierte los enlaces en bloques para separarlos verticalmente */
            margin-bottom: 10px; /* Espacio entre los enlaces */
        }

        .footer-links ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .footer-links h3 {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        p {
            margin: 0;
        }

        /* Ajuste de los iconos */
        .footer-links img {
            margin-bottom:2%;
        }
    </style>
</head>
<body>

<footer>
    <div class="footer-section">
        <div class="footer-links">
            <h3>Sobre Nosotros:</h3>
            <ul>
                <li><a href="#">Política de privacidad</a></li>
                <li><a href="#">Términos y condiciones</a></li>
                <li><a href="#">Contacto</a></li>
                <li><a href="#">Ayuda</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-section">
        <div class="footer-links">
            <h3>Encuéntranos:</h3>
            <ul>
                <li><img src="{{asset('imagenes/facebook.png')}}" width="25" height="25" class="facebook"></li>
                <li><img src="{{asset('imagenes/twitter.png')}}" width="25" height="25" class="twitter"></li>
                <li><img src="{{asset('imagenes/instagram.png')}}" width="25" height="25" class="instagram"></li>
                <li><img src="{{asset('imagenes/tik-tok.png')}}" width="25" height="25" class="tik"></li>
            </ul>
        </div>
    </div>

    <div class="footer-section">
        <div class="footer-links">
            <h3>Aceptamos:</h3>
            <ul>
                <li><img src="{{asset('imagenes/visa.png')}}" width="30" height="30" class="facebook"></li>
                <li><img src="{{asset('imagenes/paysafecard.png')}}" width="30" height="30" class="twitter"></li>
                <li><img src="{{asset('imagenes/paypal.png')}}" width="30" height="30" class="instagram"></li>
                <li><img src="{{asset('imagenes/mastercard.png')}}" width="30" height="30" class="tik"></li>
            </ul>
        </div>
    </div>

    <div class="footer-section">
        <p>&copy; 2024 Tu Empresa. Todos los derechos reservados.</p>
    </div>
</footer>

</body>
</html>
