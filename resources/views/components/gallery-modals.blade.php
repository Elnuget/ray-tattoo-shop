<!-- Gallery Modals -->
<section>
    @if(isset($imagenesTattoo))
        @foreach($imagenesTattoo as $imagen)
            <div class="portfolio-modal modal fade mt-5" id="portfoliomodal{{ $imagen->id }}" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content text-center">
                        <div class="modal-header border-0">
                            <h5 class="modal-title w-100">
                                {{ $imagen->descripcion ?? 'Tatuaje' }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <div class="container-fluid py-3">
                                <div class="row justify-content-center">
                                    <div class="col-sm-12">
                                        <img src="{{ $imagen->url }}" 
                                             class="img-fluid rounded" 
                                             alt="{{ $imagen->descripcion ?? 'Tatuaje por ' . $imagen->proyecto->user->name }}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h6 class="text-muted">Artista: {{ $imagen->proyecto->user->name }}</h6>
                                        @if($imagen->proyecto->cliente)
                                            <small class="text-muted">Cliente: {{ $imagen->proyecto->cliente }}</small>
                                        @endif
                                        @if($imagen->descripcion)
                                            <p class="mt-2">{{ $imagen->descripcion }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</section>
