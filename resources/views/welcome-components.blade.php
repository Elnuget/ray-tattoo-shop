@extends('layouts.welcome')

@section('title', 'ROTO Tattoo Studio')

@section('body-class', 'loading')

@section('preloader-script')
// Remover la clase loading y el preloader después de la animación
setTimeout(function() {
    document.body.classList.remove('loading');
    document.getElementById('deleted').style.display = 'none';
}, 4500);
@endsection

@section('content')
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
@endsection
