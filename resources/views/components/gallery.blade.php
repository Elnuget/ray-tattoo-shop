<!-- Gallery Section -->
<section id="section2" class="portfolio py-5">
    <div class="container text-center py-5">
        <h1 class="text-center pb-5" data-aos="fade-down">Galería</h1>
        <div class="control dropdown mb-4">
            <ul id="categories" class="list-unstyled d-flex flex-wrap justify-content-center">
                <li class="button list-item" data-category="hepsi">Todos</li>
                <li class="button list-item" data-category="ozan">Ozan</li>
                <li class="button list-item" data-category="ersin">Betül</li>
                <li class="button list-item" data-category="betül">Ersin</li>
                <li class="button list-item" data-category="elif">Eylem</li>
            </ul>
        </div>
        <div id="photos">
            <div class="row g-3">
                @for($i = 1; $i <= 12; $i++)
                    @php
                        $artist = '';
                        if($i <= 3) $artist = 'ozan';
                        elseif($i <= 6) $artist = 'ersin';
                        elseif($i <= 9) $artist = 'betül';
                        else $artist = 'elif';
                    @endphp
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="item">
                            <img src="images/{{ $i }}.jpg" 
                                 class="img-fluid" 
                                 data-category-ersin="{{ $artist === 'ersin' ? 'true' : 'false' }}" 
                                 data-category-betül="{{ $artist === 'betül' ? 'true' : 'false' }}" 
                                 data-category-elif="{{ $artist === 'elif' ? 'true' : 'false' }}" 
                                 data-category-ozan="{{ $artist === 'ozan' ? 'true' : 'false' }}" 
                                 data-category-hepsi="true" 
                                 alt="Tattoo artwork {{ $i }}"
                                 loading="lazy">
                            <span>
                                <i class="fas fa-plus" 
                                   data-bs-toggle="modal" 
                                   data-bs-target="#portfoliomodal{{ $i === 1 ? '' : $i }}"
                                   aria-label="Ver imagen completa"></i>
                            </span>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</section>
