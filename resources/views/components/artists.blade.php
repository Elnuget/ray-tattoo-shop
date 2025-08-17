<!-- Artists Section -->
<section id="section1" class="about py-5">
    <div class="container py-5">
        <h1 class="text-center py-5" data-aos="fade-down">Nuestros Artistas</h1>
        
        @forelse($artists as $index => $artist)
            @include('components.artist-card', [
                'name' => $artist->name,
                'image' => $artist->foto ? asset('storage/' . $artist->foto) : asset('images/default-artist.jpg'),
                'description' => $artist->descripcion ?? 'Artista especializado en tatuajes únicos y personalizados.',
                'instagram' => isset($artist->redes['instagram']) ? 'https://www.instagram.com/' . ltrim($artist->redes['instagram'], '@') : null,
                'facebook' => isset($artist->redes['facebook']) ? (str_starts_with($artist->redes['facebook'], 'http') ? $artist->redes['facebook'] : 'https://www.facebook.com/' . $artist->redes['facebook']) : null,
                'twitter' => isset($artist->redes['twitter']) ? 'https://www.twitter.com/' . ltrim($artist->redes['twitter'], '@') : null,
                'tiktok' => isset($artist->redes['tiktok']) ? 'https://www.tiktok.com/@' . ltrim($artist->redes['tiktok'], '@') : null,
                'imagePosition' => $index % 2 === 0 ? 'left' : 'right'
            ])
        @empty
            <!-- Mensaje cuando no hay artistas -->
            <div class="row">
                <div class="col-12 text-center py-5">
                    <h3 class="text-muted mb-4">Próximamente conocerás a nuestro talentoso equipo</h3>
                    <p class="text-muted">Estamos preparando los perfiles de nuestros increíbles artistas.</p>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        @auth
                            @if(auth()->user()->es_admin)
                                <a href="{{ route('users.create') }}" class="btn btn-outline-light">
                                    <i class="bi bi-plus-circle"></i> Añadir Artista
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</section>
