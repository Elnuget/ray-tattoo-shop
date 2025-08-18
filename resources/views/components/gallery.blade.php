<!-- Gallery Section -->
<section id="section2" class="portfolio py-5">
    <div class="container text-center py-5">
        <h1 class="text-center pb-5" data-aos="fade-down">Galería</h1>
        
        @if($todosUsuarios && $todosUsuarios->count() > 0)
            <div class="control dropdown mb-4">
                <ul id="categories" class="list-unstyled d-flex flex-wrap justify-content-center">
                    <li class="button list-item active" data-category="todos">Todos</li>
                    @foreach($todosUsuarios as $usuario)
                        <li class="button list-item" data-category="user-{{ $usuario->id }}">{{ $usuario->name }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div id="photos">
            <div class="row g-3">
                @forelse($imagenesTattoo as $index => $imagen)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="item" data-user-id="{{ $imagen->proyecto->user->id }}">
                            <img src="{{ $imagen->url }}" 
                                 class="img-fluid" 
                                 data-category-todos="true"
                                 data-category-user-{{ $imagen->proyecto->user->id }}="true"
                                 alt="{{ $imagen->descripcion ?? 'Tatuaje por ' . $imagen->proyecto->user->name }}"
                                 loading="lazy">
                            <span>
                                <i class="fas fa-plus" 
                                   data-bs-toggle="modal" 
                                   data-bs-target="#portfoliomodal{{ $imagen->id }}"
                                   aria-label="Ver imagen completa"></i>
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h3 class="text-muted mb-4">Próximamente podrás ver nuestros trabajos</h3>
                        <p class="text-muted">Estamos preparando nuestra galería de tatuajes.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
