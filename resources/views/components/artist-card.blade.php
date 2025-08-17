<!-- Single Artist Component -->
<div class="row mb-5">
    @if($imagePosition === 'left')
        <div class="col-5 py-3 align-self-center">
            <img src="{{ $image }}" data-aos="fade-right" class="img-fluid rounded" alt="{{ $name }}">
        </div>
        <div class="col-7 text-center align-self-center" data-aos="fade-left">
            <h5 class="text-center pt-4">{{ $name }}</h5>
            <p class="py-3 text-center">{{ $description }}</p>
            <a class="bi bi-instagram button" href="{{ $instagram }}" target="_blank"> Instagram</a>
        </div>
    @else
        <div class="col-7 text-center align-self-center" data-aos="fade-right">
            <h5 class="text-center pt-4">{{ $name }}</h5>
            <p class="py-3 text-center">{{ $description }}</p>
            <a class="bi bi-instagram button" href="{{ $instagram }}" target="_blank"> Instagram</a>
        </div>
        <div class="col-5 py-4 align-self-center">
            <img src="{{ $image }}" data-aos="fade-left" class="img-fluid float-end rounded" alt="{{ $name }}">
        </div>
    @endif
</div>
