<!-- Artists Section -->
<section id="section1" class="about py-5">
    <div class="container py-5">
        <h1 class="text-center py-5" data-aos="fade-down">Nuestros Artistas</h1>
        
        @include('components.artist-card', [
            'name' => 'Ozan',
            'image' => 'images/ozan.jpg',
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa et, ullam est voluptates natus excepturi reiciendis, voluptate mollitia soluta fugit saepe nisi rerum rem ea, veniam reprehenderit aspernatur magnam modi.',
            'instagram' => 'https://www.instagram.com/ozansahinink/',
            'imagePosition' => 'left'
        ])
        
        @include('components.artist-card', [
            'name' => 'Betül',
            'image' => 'images/betul.jpg',
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa et, ullam est voluptates natus excepturi reiciendis, voluptate mollitia soluta fugit saepe nisi rerum rem ea, veniam reprehenderit aspernatur magnam modi.',
            'instagram' => 'https://www.instagram.com/lutebec/',
            'imagePosition' => 'right'
        ])

        @include('components.artist-card', [
            'name' => 'Ersin',
            'image' => 'images/ersin.jpg',
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa et, ullam est voluptates natus excepturi reiciendis, voluptate mollitia soluta fugit saepe nisi rerum rem ea, veniam reprehenderit aspernatur magnam modi.',
            'instagram' => 'https://www.instagram.com/lutebec/',
            'imagePosition' => 'left'
        ])
        
        @include('components.artist-card', [
            'name' => 'Eylem',
            'image' => 'images/eylem.jpg',
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa et, ullam est voluptates natus excepturi reiciendis, voluptate mollitia soluta fugit saepe nisi rerum rem ea, veniam reprehenderit aspernatur magnam modi.',
            'instagram' => 'https://www.instagram.com/artofeylem/',
            'imagePosition' => 'right'
        ])
    </div>
</section>
