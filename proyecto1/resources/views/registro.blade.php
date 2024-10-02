<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0 !important;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 5%;
            padding-bottom: 5%;
        }

        .login-container {
            background-color: #f8f9fa; /* Color de fondo grisáceo */
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
            margin: 20px;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #333333;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #007bff;
        }

        .btn-login {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .register-link {
            margin-top: 15px;
            display: block;
            color: #007bff;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #1a1a1a;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
        }

        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    @include('menu')

    <div class="content">
        <div class="login-container">
            <h2>Registro</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ url('/registro') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" id="usuario" placeholder="Ingrese su usuario">
                </div>
                <div class="form-group">
                    <label for="correo">Correo:</label>
                    <input type="email" name="correo" id="correo" placeholder="Ingrese su correo">
                </div>
                <div class="form-group">
                    <label for="clave">Clave:</label>
                    <input type="password" name="clave" id="clave" placeholder="Ingrese su clave">
                </div>
                <button type="submit" class="btn-login">Registrarse</button>
            </form>
            <a href="{{ url('/login') }}" class="register-link">¿Ya tienes una cuenta? Inicia sesión aquí</a>
        </div>
    </div>

    <footer>
        @include('footer')
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
