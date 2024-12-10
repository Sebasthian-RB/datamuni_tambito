<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Desarrollo Social">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiEHVDgPWVCtC0dajYZBC_mDHBlmRBAmbtOc74Ko-ljnctIllQu0R9jCyZSeFc0VgVobnolCgPDvk-cUv8jBnkilDdVW87OfK96XnM1nc6JqByPwA4KO9Xq60T_giMurdfIVj-ATeXGG7A3/s1600/IMG_0410.JPG');
            background-size: cover;
            background-position: center;
            filter: blur(1px);
            z-index: 1;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2;
        }

        .login-container {
            position: relative;
            z-index: 3;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            height: 100%;
        }

        .logo {
            height: 100px;
            margin-bottom: 20px;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .form-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 20px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            padding: 10px;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #E1AD01;
            box-shadow: 0 0 5px rgba(225, 173, 1, 0.5);
        }

        .btn-submit {
            padding: 15px 30px;
            border-radius: 50px;
            background-color: #E1AD01;
            color: #fff;
            font-weight: bold;
            font-size: 1.1rem;
            width: 100%;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #D19A00;
        }

        .social-icons {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .social-icons a {
            color: #fff;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #E1AD01;
        }

        footer {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
            color: #fff;
            font-size: 0.9rem;
        }

        .links-container {
            margin-top: 20px;
        }

        .links-container a {
            color: #E1AD01;
            text-decoration: none;
            font-size: 1rem;
        }

        .links-container a:hover {
            text-decoration: underline;
        }
        .ingresar-title {
            display: block;
            /* Asegura que esté en su propia línea */
            font-size: 2rem;
            /* Tamaño grande para destacar */
            font-weight: bold;
            /* Negrita */
            color: #E1AD01;
            /* Color profesional, puedes ajustarlo según el diseño */
            text-transform: uppercase;
            /* Texto en mayúsculas para mayor impacto */
            letter-spacing: 2px;
            /* Espaciado elegante */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            /* Sombra para resaltar */
            margin-top: 10px;
            /* Separación del título principal */
            margin-bottom: 20px;
            /* Separación con el subtítulo */
        }
    </style>
</head>

<body>
    <div class="background-image"></div>
    <div class="overlay"></div>

    <div class="login-container">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Logo" class="logo">
        
        <div class="form-container">
            <h2 class="ingresar-title">Iniciar sesión</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required autofocus>
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                
                <button type="submit" class="btn-submit">Iniciar sesión</button>
            </form>
            
            <!-- Enlaces de recuperar contraseña y registrarse -->
            <div class="links-container">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="d-block">Olvidé mi contraseña</a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="d-block">¿No tienes cuenta? Regístrate</a>
                @endif
            </div>

            <div class="social-icons">
                <a href="https://twitter.com" target="_blank" class="text-white">
                    <i class="fab fa-twitter fa-2x"></i>
                </a>
                <a href="https://facebook.com" target="_blank" class="text-white">
                    <i class="fab fa-facebook fa-2x"></i>
                </a>
                <a href="mailto:example@example.com" target="_blank" class="text-white">
                    <i class="fas fa-envelope fa-2x"></i>
                </a>
            </div>
        </div>

        <footer>
            <p>© 2024 Municipalidad Tambo. Todos los derechos reservados</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
