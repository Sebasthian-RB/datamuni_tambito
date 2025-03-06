<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Desarrollo Social">
    <title>Bienvenido</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            /* Asegura que el fondo cubra toda la pantalla */
            margin: 0;
            overflow: hidden;
            /* Evita scroll en el body */
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
            /* Efecto de desenfoque */
            z-index: 1;
            /* Coloca la imagen detrás */
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            /* Capa negra semitransparente */
            z-index: 2;
            /* Coloca la capa sobre la imagen */
        }

        .cover-container {
            position: relative;
            z-index: 3;
            /* Asegura que el contenido esté por encima de la capa */
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* Centra verticalmente */
            align-items: center;
            /* Centra horizontalmente */
            text-align: center;
            /* Centra el texto */
        }

        .nav-link {
            margin-left: 15px;
            /* Agrega separación entre los enlaces */
            color: white;
            /* Color de texto blanco */
        }

        .nav-link:hover {
            text-decoration: underline;
            /* Efecto hover */
        }

        .header {
            display: flex;
            justify-content: space-between;
            /* Espacio entre el logo y los enlaces */
            align-items: center;
            /* Alinea verticalmente */
            width: 100%;
            position: relative;
            /* Posicionamiento relativo */
        }

        .logo {
            height: 85px;
            /* Ajusta el tamaño del logo */
        }

        .nav-center {
            position: absolute;
            /* Posiciona el nav en el centro */
            left: 50%;
            transform: translateX(-50%);
            /* Centra horizontalmente */
        }

        a {
            text-decoration: none;
        }

        /* Estilo de enlaces del menú */
        .menu__link {
            color: #fff;
            line-height: 2;
            position: relative;
        }

        .menu__link::before {
            content: '';
            width: 0;
            height: 2px;
            border-radius: 2px;
            background-color: #fff;
            position: absolute;
            bottom: -.25rem;
            left: 0;
            transition: width .4s;
        }

        .menu__link:hover::before {
            width: 100%;
        }

        /* From Uiverse.io by barisdogansutcu */
        button {
            padding: 17px 40px;
            border-radius: 50px;
            cursor: pointer;
            border: 0;
            background-color: rgba(225, 173, 1, 1);
            box-shadow: rgb(0 0 0 / 5%) 0 0 8px;
            letter-spacing: 1.5px;
            color: #000000;
            text-transform: uppercase;
            font-size: 15px;
            font-weight: bold;
            /* Texto en negrita */
            transition: all 0.5s ease;
        }

        button:hover {
            letter-spacing: 3px;
            background-color: hsl(46, 99%, 44%, 100%);
            color: hsl(0, 0%, 13%);
            box-shadow: rgba(228, 205, 59, 1) 0px 7px 29px 0px;
        }

        button:active {
            letter-spacing: 3px;
            background-color: hsl(46, 99%, 44%, 100%);
            color: hsl(0, 0%, 13%);
            box-shadow: rgba(228, 205, 59, 1) 0px 7px 29px 0px;
            transform: translateY(10px);
            transition: 100ms;
        }

        .datamuni-title {
            display: block;
            /* Asegura que esté en su propia línea */
            font-size: 3rem;
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

        .social-icons {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            /* Espaciado entre íconos */
            z-index: 1000;
            /* Asegura que esté sobre otros elementos */
        }

        .social-icons a {
            text-decoration: none;
            color: rgba(255, 255, 255, 0.8);
            /* Color blanco con opacidad */
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: rgba(255, 255, 255, 1);
            /* Color blanco completo al pasar el cursor */
        }

        .social-icons i {
            background-color: rgba(0, 0, 0, 0.5);
            /* Fondo oscuro detrás del ícono */
            border-radius: 50%;
            padding: 10px;
            transition: background-color 0.3s ease;
        }

        .social-icons i:hover {
            background-color: rgba(34, 139, 34, 1);
            /* Fondo cambia al verde principal */
        }
    </style>
</head>

<body class="d-flex h-100 text-center">

    <div class="background-image"></div> <!-- Imagen de fondo con desenfoque -->
    <div class="overlay"></div> <!-- Capa oscurecedora -->
    @include('layouts.logins.logins')

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto header">
            <div class="d-flex align-items-center">
                <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Logo" class="logo">
            </div>
            <nav class="nav nav-masthead justify-content-center nav-center">
                <a class="menu__link fw-bold py-1 px-4" href="#" aria-label="Ayuda">Ayuda</a>
                <a class="menu__link fw-bold py-1 px-4" href="#" aria-label="Avisos">Avisos</a>
                <a class="menu__link fw-bold py-1 px-4" href="#" aria-label="Contacto">Contacto</a>
            </nav>
            <div>
                <nav class="nav nav-masthead">
                    @if (Route::has('login'))
                        @auth
                            <a class="menu__link fw-bold py-1 px-4" href="{{ url('/dashboard') }}"
                                aria-label="Dashboard">Dashboard</a>
                        @else
                            <a class="menu__link fw-bold py-1 px-4" href="{{ route('login') }}" aria-label="Login">Login</a>

                        @endauth
                    @endif
                </nav>
            </div>
        </header>
        <main class="px-3">
            <h1 class="text-light">
                Bienvenido a la Plataforma
                <span class="datamuni-title">DataMuni-Tambo</span>
            </h1>
            <p class="lead text-light">Tu herramienta de cruce de datos.</p>
            <p class="lead">
                <button onclick="window.location.href='{{ route('login') }}'" class="btn-custom">Ingresar</button>
            </p>
            <div class="social-icons">
                <a href="https://twitter.com" target="_blank" class="text-white">
                    <i class="fab fa-x-twitter fa-2x"></i>
                </a>
                <a href="https://facebook.com" target="_blank" class="text-white">
                    <i class="fab fa-facebook fa-2x"></i>
                </a>
                <a href="mailto:example@example.com" target="_blank" class="text-white">
                    <i class="fas fa-envelope fa-2x"></i>
                </a>
            </div>
        </main>

        <footer class="mt-auto text-white-50">
            <p>© 2024 Municipalidad Tambo. Todos los derechos reservados</p>
        </footer>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
