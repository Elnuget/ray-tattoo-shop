<!-- Services Section -->
<section class="services py-5">
    <div class="container py-5">
        <h1 class="text-center pb-5" data-aos="fade-down">Servicios</h1>
        <div class="row pb-3">
            @include('components.service-card', [
                'title' => 'TATTOO',
                'icon' => 'images/coverup.png',
                'description' => '¡Ten estilo en ROTO Tattoo Studio! Nuestros artistas experimentados trabajarán contigo para crear una pieza única que refleje tu personalidad y estilo.',
                'animation' => 'fade-right'
            ])

            @include('components.service-card', [
                'title' => 'PIERCING',
                'icon' => 'images/piercing.png',
                'description' => 'Nuestros artistas experimentados utilizan las últimas técnicas y equipos para asegurar que tu piercing se realice de forma segura y con el mínimo dolor.',
                'animation' => 'fade-up'
            ])

            @include('components.service-card', [
                'title' => 'COVER UP',
                'icon' => 'images/coverup.png',
                'description' => '¡Cubre tu pasado con ROTO Tattoo Studio! Nuestros artistas especializados en cover-up transforman tatuajes antiguos en nuevas y hermosas obras de arte.',
                'animation' => 'fade-left'
            ])
        </div>
    </div>
</section>
