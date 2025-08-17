<!-- Single Artist Component -->
<div class="row mb-5">
    @if($imagePosition === 'left')
        <div class="col-5 py-3 align-self-center">
            <img src="{{ $image }}" data-aos="fade-right" class="img-fluid rounded" alt="{{ $name }}" style="object-fit: cover; height: 300px; width: 100%;">
        </div>
        <div class="col-7 text-center align-self-center" data-aos="fade-left">
            <h5 class="text-center pt-4">{{ $name }}</h5>
            <p class="py-3 text-center">{{ $description }}</p>
            
            <!-- Redes Sociales -->
            <div class="social-links d-flex justify-content-center gap-3">
                @if(isset($instagram) && $instagram)
                    <a class="btn btn-dark btn-sm" href="{{ $instagram }}" target="_blank" title="Instagram">
                        <i class="bi bi-instagram text-white"></i> Instagram
                    </a>
                @endif
                
                @if(isset($facebook) && $facebook)
                    <a class="btn btn-primary btn-sm" href="{{ $facebook }}" target="_blank" title="Facebook">
                        <i class="bi bi-facebook text-white"></i> Facebook
                    </a>
                @endif
                
                @if(isset($twitter) && $twitter)
                    <a class="btn btn-info btn-sm" href="{{ $twitter }}" target="_blank" title="Twitter">
                        <i class="bi bi-twitter text-white"></i> Twitter
                    </a>
                @endif
                
                @if(isset($tiktok) && $tiktok)
                    <a class="btn btn-danger btn-sm" href="{{ $tiktok }}" target="_blank" title="TikTok">
                        <i class="bi bi-tiktok text-white"></i> TikTok
                    </a>
                @endif
            </div>
        </div>
    @else
        <div class="col-7 text-center align-self-center" data-aos="fade-right">
            <h5 class="text-center pt-4">{{ $name }}</h5>
            <p class="py-3 text-center">{{ $description }}</p>
            
            <!-- Redes Sociales -->
            <div class="social-links d-flex justify-content-center gap-3">
                @if(isset($instagram) && $instagram)
                    <a class="btn btn-dark btn-sm" href="{{ $instagram }}" target="_blank" title="Instagram">
                        <i class="bi bi-instagram text-white"></i> Instagram
                    </a>
                @endif
                
                @if(isset($facebook) && $facebook)
                    <a class="btn btn-primary btn-sm" href="{{ $facebook }}" target="_blank" title="Facebook">
                        <i class="bi bi-facebook text-white"></i> Facebook
                    </a>
                @endif
                
                @if(isset($twitter) && $twitter)
                    <a class="btn btn-info btn-sm" href="{{ $twitter }}" target="_blank" title="Twitter">
                        <i class="bi bi-twitter text-white"></i> Twitter
                    </a>
                @endif
                
                @if(isset($tiktok) && $tiktok)
                    <a class="btn btn-danger btn-sm" href="{{ $tiktok }}" target="_blank" title="TikTok">
                        <i class="bi bi-tiktok text-white"></i> TikTok
                    </a>
                @endif
            </div>
        </div>
        <div class="col-5 py-4 align-self-center">
            <img src="{{ $image }}" data-aos="fade-left" class="img-fluid float-end rounded" alt="{{ $name }}" style="object-fit: cover; height: 300px; width: 100%;">
        </div>
    @endif
</div>
