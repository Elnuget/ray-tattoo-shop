<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Acceso Denegado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm overflow-hidden">
                <div class="p-8 text-center">
                    <!-- Icono de Error -->
                    <div class="mb-6">
                        <svg class="mx-auto h-24 w-24 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>

                    <!-- Título -->
                    <h1 class="text-4xl font-bold text-white mb-4">
                        403 - Acceso Denegado
                    </h1>

                    <!-- Mensaje -->
                    <p class="text-xl text-gray-300 mb-6">
                        Lo sentimos, no tienes permisos para acceder a esta sección.
                    </p>
                    
                    <p class="text-gray-400 mb-8">
                        Solo los administradores pueden gestionar usuarios. Si crees que esto es un error, contacta al administrador del sistema.
                    </p>

                    <!-- Botones de Acción -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-black text-white font-semibold rounded-lg hover:from-red-700 hover:to-gray-900 transition-all duration-300 border border-red-500/30">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Ir al Dashboard
                        </a>
                        
                        <a href="{{ url()->previous() }}" class="inline-flex items-center px-6 py-3 bg-gray-600/20 text-gray-300 font-semibold rounded-lg hover:bg-gray-600/30 transition-all duration-300 border border-gray-500/30">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Volver Atrás
                        </a>
                    </div>

                    <!-- Información Adicional -->
                    <div class="mt-8 p-4 bg-red-600/10 border border-red-500/30 rounded-lg">
                        <p class="text-sm text-red-300">
                            <strong>¿Necesitas acceso de administrador?</strong><br>
                            Contacta al administrador del sistema para solicitar permisos especiales.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
