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
    
    <title>ROTO Tattoo Studio - Tatuajes Profesionales en Quito, Ecuador</title>
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

    <!-- Botón flotante de WhatsApp -->
    <div class="whatsapp-float">
        <a href="https://wa.me/593995901750?text=Hola,%20me%20interesa%20información%20sobre%20sus%20servicios%20de%20tatuajes" 
           target="_blank" 
           class="whatsapp-button"
           title="Contactar por WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <!-- Barra flotante de redes sociales -->
    <div class="social-sidebar">
        <div class="social-container">
            <!-- Agendar Cita -->
            <a href="https://form.jotform.com/242916656121658" 
               target="_blank" 
               class="social-button calendar-btn"
               title="Agendar una Cita">
                <i class="fas fa-calendar-plus"></i>
            </a>
            
            <!-- TikTok -->
            <a href="https://www.tiktok.com/@roto.tattoostudio" 
               target="_blank" 
               class="social-button tiktok-btn"
               title="Síguenos en TikTok">
                <i class="fab fa-tiktok"></i>
            </a>
            
            <!-- Instagram -->
            <a href="https://www.instagram.com/roto_tattoostudio" 
               target="_blank" 
               class="social-button instagram-btn"
               title="Síguenos en Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            
            <!-- Facebook -->
            <a href="https://www.facebook.com/profile.php?id=61553582873221&mibextid=LQQJ4d" 
               target="_blank" 
               class="social-button facebook-btn"
               title="Síguenos en Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            
            <!-- Guía de Precios -->
            <a href="https://drive.google.com/file/d/1AVMF8jtFP996OUcjEoSFIWxRVlzugcqy/view?usp=drivesdk" 
               target="_blank" 
               class="social-button price-btn"
               title="Ver Guía de Precios">
                <i class="fas fa-file-invoice-dollar"></i>
            </a>
        </div>
    </div>

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

    <!-- Estilos para el botón flotante de WhatsApp -->
    <style>
        /* Estilos base para WhatsApp */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .whatsapp-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #25D366;
            color: white;
            text-align: center;
            font-size: 28px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .whatsapp-button:hover {
            background-color: #1ebe57;
            color: white;
            text-decoration: none;
            box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.3);
            transform: scale(1.1);
        }

        .whatsapp-button i {
            margin: 0;
        }

        /* Barra flotante de redes sociales - OPTIMIZADA */
        .social-sidebar {
            position: fixed;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 999;
            max-width: 50px;
        }

        .social-container {
            display: flex;
            flex-direction: column;
            gap: 8px;
            width: 100%;
        }

        .social-button {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            color: white;
            text-align: center;
            font-size: 18px;
            box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            text-decoration: none;
            position: relative;
            flex-shrink: 0;
        }

        .social-button:hover {
            color: white;
            text-decoration: none;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }

        .social-button i {
            margin: 0;
        }

        /* Colores específicos para cada botón */
        .calendar-btn {
            background-color: #FF6B35;
        }

        .calendar-btn:hover {
            background-color: #E55A2B;
        }

        .tiktok-btn {
            background-color: #000000;
        }

        .tiktok-btn:hover {
            background-color: #333333;
        }

        .instagram-btn {
            background: linear-gradient(45deg, #F56040, #C13584, #833AB4);
        }

        .instagram-btn:hover {
            background: linear-gradient(45deg, #E55A2B, #A8296B, #6A2C91);
        }

        .facebook-btn {
            background-color: #1877F2;
        }

        .facebook-btn:hover {
            background-color: #166FE5;
        }

        .price-btn {
            background-color: #28A745;
        }

        .price-btn:hover {
            background-color: #218838;
        }

        /* MEJORAS RESPONSIVAS PARA MÓVILES - OPTIMIZADAS */
        
        /* Tablet - 768px y menor */
        @media (max-width: 768px) {
            /* Ocultar redes sociales en tablet para evitar interferencias */
            .social-sidebar {
                display: none;
            }

            /* Asegurar que las imágenes no se desborden */
            .carousel-inner img {
                max-height: 300px;
                object-fit: cover;
            }

            /* Mejorar texto del hero en tablet */
            #blacklinetext {
                font-size: 2.5rem !important;
            }

            #blacklinetext small {
                font-size: 1.2rem !important;
            }

            /* Evitar scroll horizontal */
            body, html {
                overflow-x: hidden;
                max-width: 100vw;
            }
        }

        /* Móvil - 576px y menor */
        @media (max-width: 576px) {
            /* Ocultar completamente las redes sociales en móvil */
            .social-sidebar {
                display: none !important;
            }

            /* WhatsApp optimizado para móvil */
            .whatsapp-float {
                bottom: 20px;
                right: 20px;
                width: 55px;
                height: 55px;
                z-index: 1001;
            }
            
            .whatsapp-button {
                width: 55px;
                height: 55px;
                font-size: 26px;
            }

            /* Hero section más legible en móvil */
            #blacklinetext {
                font-size: 2rem !important;
                line-height: 1.1 !important;
                text-align: center;
            }

            #blacklinetext small {
                font-size: 1rem !important;
            }

            .main .container {
                padding: 1rem !important;
            }

            /* Botones del hero más accesibles */
            .d-flex.gap-3 {
                flex-direction: column !important;
                align-items: center;
                gap: 1rem !important;
            }

            .btn-custom {
                width: 100%;
                max-width: 250px;
            }

            .bt1, .bt2 {
                width: 100% !important;
                padding: 12px 20px !important;
                font-size: 1rem !important;
            }

            /* Carrusel optimizado para móvil */
            .carousel-inner img {
                max-height: 250px;
                object-fit: cover;
                border-radius: 10px;
            }

            /* Navbar brand más pequeño */
            .navbar-brand {
                font-size: 0.9rem !important;
            }

            .navbar-brand span:first-child {
                font-size: 1rem !important;
            }

            .navbar-brand span:last-child {
                font-size: 0.7rem !important;
            }

            /* Enlaces del navbar más accesibles */
            .navbar-nav .nav-link {
                padding: 0.75rem 1rem !important;
                text-align: center;
                font-size: 0.95rem;
            }

            /* Secciones con mejor padding */
            section {
                padding: 2rem 0 !important;
            }

            .py-5 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important;
            }

            /* Títulos más legibles */
            h3 {
                font-size: 1.5rem !important;
            }

            h6 {
                font-size: 1rem !important;
            }

            /* Cards responsivas */
            .card {
                margin-bottom: 1rem !important;
            }

            /* Formularios más accesibles */
            .form-control {
                font-size: 16px !important; /* Evita zoom en iOS */
                padding: 0.75rem !important;
            }

            .btn {
                padding: 0.75rem 1.5rem !important;
                font-size: 1rem !important;
            }

            /* Accordion más legible */
            .accordion-button {
                font-size: 0.95rem !important;
                padding: 1rem !important;
            }

            .accordion-body {
                font-size: 0.9rem !important;
                line-height: 1.5 !important;
            }

            /* Evitar overflow horizontal */
            body, html {
                overflow-x: hidden !important;
                max-width: 100vw !important;
            }

            .container, .container-fluid {
                max-width: 100% !important;
                overflow-x: hidden !important;
                padding-left: 15px !important;
                padding-right: 15px !important;
            }
        }

        /* Solo mostrar redes sociales en desktop grande */
        @media (min-width: 992px) {
            .social-sidebar {
                display: block;
                left: 20px;
            }

            .social-button {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }
        }

        /* Extra large screens */
        @media (min-width: 1200px) {
            .social-sidebar {
                left: 30px;
            }
        }

        /* Asegurar que todo el contenido sea visible */
        body {
            overflow-x: hidden !important;
            position: relative;
        }

        .container-fluid {
            max-width: 100vw !important;
            overflow-x: hidden !important;
        }

        /* Prevenir problemas de layout */
        * {
            box-sizing: border-box;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</body>
</body>
</html>