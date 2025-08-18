<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    
    <!-- Bootstrap CSS (debe ir primero) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <!-- AOS (Animate On Scroll) CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom Styles (deben ir después de Bootstrap) -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gallery-filter.css') }}">
    
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/c26cd2166c.js" crossorigin="anonymous"></script>
    
    <!-- jQuery (debe ir antes de Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.6.2.slim.js" integrity="sha256-OflJKW8Z8amEUuCaflBZJ4GOg4+JnNh9JdVfoV+6biw=" crossorigin="anonymous"></script>
    
    <!-- Custom Script (si existe) -->
    @if(file_exists(public_path('script.js')))
        <script src="{{ asset('script.js') }}"></script>
    @endif
    
    <title>Rotto Tattoo Studio</title>
</head>
<body class="loading">  
    <!-- Preloader -->
    @include('components.preloader')

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Hero Section -->
    @include('components.hero')

    <!-- Artists Section -->
    @include('components.artists')

    <!-- Services Section -->
    @include('components.services')

    <!-- Gallery Section -->
    @include('components.gallery')

    <!-- Gallery Modals -->
    @include('components.gallery-modals')

    <!-- FAQ Section -->
    @include('components.faq')

    <!-- Contact Section -->
    @include('components.contact')

    <!-- Footer -->
    @include('components.footer')

    <!-- Scripts al final del body para mejor rendimiento -->
    
    <!-- AOS JavaScript -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    
    <!-- Popper.js (requerido para Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Script principal del sitio -->
    <script src="{{ asset('script.js') }}"></script>
    
    <!-- JavaScript responsivo -->
    <script src="{{ asset('js/responsive.js') }}"></script>
    
    <!-- JavaScript para filtros de galería -->
    <script src="{{ asset('js/gallery-filter.js') }}"></script>
    
    <!-- Inicialización de scripts -->
    <script>
        // Script del preloader - remover la clase loading y el preloader después de la animación
        setTimeout(function() {
            document.body.classList.remove('loading');
            document.getElementById('deleted').style.display = 'none';
        }, 4500);

        // Inicialización de AOS
        AOS.init({
            delay: 0,
            once: true,
            duration: 400,
            offset: -475,
        });
    </script>
</body>
</body>
</html>