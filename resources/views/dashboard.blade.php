<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard - Rotto Tattoo Studio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm mb-8 overflow-hidden">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">
                                ¡Bienvenido, {{ Auth::user()->name }}! 🎨
                            </h1>
                            <p class="text-gray-300">
                                Panel de control de Rotto Tattoo Studio
                            </p>
                        </div>
                        <div class="w-20 h-20 bg-gradient-to-r from-red-600 to-black rounded-full flex items-center justify-center shadow-xl shadow-red-500/30 border border-red-500/30">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Estadísticas del Usuario -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-black/30 backdrop-blur-sm rounded-lg p-4 border border-red-500/20">
                            <h3 class="text-lg font-semibold text-white mb-2">Total de Proyectos</h3>
                            <div class="text-3xl font-bold text-red-400">{{ $totalProyectos }}</div>
                        </div>

                        <div class="bg-black/30 backdrop-blur-sm rounded-lg p-4 border border-red-500/20">
                            <h3 class="text-lg font-semibold text-white mb-2">Proyectos Activos</h3>
                            <div class="text-3xl font-bold text-yellow-400">{{ $proyectosActivos }}</div>
                        </div>

                        <div class="bg-black/30 backdrop-blur-sm rounded-lg p-4 border border-red-500/20">
                            <h3 class="text-lg font-semibold text-white mb-2">Completados</h3>
                            <div class="text-3xl font-bold text-green-400">{{ $proyectosCompletados }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enlaces Principales de Navegación -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @if(auth()->user()->es_admin)
                <!-- Usuarios (Solo Administradores) -->
                <a href="{{ route('users.index') }}" class="glass rounded-xl p-6 border border-red-500/20 bg-black/20 backdrop-blur-sm hover:bg-black/30 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-black rounded-lg mb-4 flex items-center justify-center border border-blue-500/30 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Usuarios</h3>
                    <p class="text-gray-300 text-sm">Gestionar usuarios del sistema</p>
                </a>
                @endif

                <!-- Proyectos -->
                <a href="{{ route('proyectos.index') }}" class="glass rounded-xl p-6 border border-red-500/20 bg-black/20 backdrop-blur-sm hover:bg-black/30 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-gradient-to-r from-red-600 to-black rounded-lg mb-4 flex items-center justify-center border border-red-500/30 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Proyectos</h3>
                    <p class="text-gray-300 text-sm">Gestionar proyectos de tatuajes</p>
                </a>

                <!-- Pagos -->
                <a href="{{ route('pagos.index') }}" class="glass rounded-xl p-6 border border-red-500/20 bg-black/20 backdrop-blur-sm hover:bg-black/30 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-600 to-black rounded-lg mb-4 flex items-center justify-center border border-green-500/30 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Pagos</h3>
                    <p class="text-gray-300 text-sm">Gestionar pagos y transacciones</p>
                </a>

                <!-- Galería -->
                <a href="{{ route('galeria.index') }}" class="glass rounded-xl p-6 border border-red-500/20 bg-black/20 backdrop-blur-sm hover:bg-black/30 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-600 to-black rounded-lg mb-4 flex items-center justify-center border border-purple-500/30 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Galería</h3>
                    <p class="text-gray-300 text-sm">Ver galería de trabajos</p>
                </a>
            </div>

            <!-- Últimos Proyectos -->
            <div class="glass rounded-xl p-6 border border-red-500/20 bg-black/20 backdrop-blur-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-white">Últimos Proyectos</h3>
                    <a href="{{ route('proyectos.index') }}" class="text-red-400 hover:text-red-300 font-medium transition-colors duration-300">
                        Ver todos →
                    </a>
                </div>

                @if($ultimosProyectos->count() > 0)
                    <div class="space-y-4">
                        @foreach($ultimosProyectos as $proyecto)
                        <div class="bg-black/30 backdrop-blur-sm rounded-lg p-4 border border-red-500/20 hover:bg-black/40 transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <h4 class="text-lg font-semibold text-white mb-1">{{ $proyecto->cliente }}</h4>
                                    <p class="text-gray-300 text-sm mb-2">{{ Str::limit($proyecto->descripcion, 80) }}</p>
                                    <div class="flex items-center space-x-4 text-sm text-gray-400">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $proyecto->created_at->format('d/m/Y') }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                            </svg>
                                            ${{ number_format($proyecto->total, 2) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="px-3 py-1 text-xs font-medium rounded-full
                                        @if($proyecto->estado === 'completado') bg-green-600/20 text-green-300 border border-green-500/30
                                        @elseif($proyecto->estado === 'en_progreso') bg-yellow-600/20 text-yellow-300 border border-yellow-500/30
                                        @elseif($proyecto->estado === 'pausado') bg-orange-600/20 text-orange-300 border border-orange-500/30
                                        @elseif($proyecto->estado === 'cancelado') bg-red-600/20 text-red-300 border border-red-500/30
                                        @else bg-gray-600/20 text-gray-300 border border-gray-500/30
                                        @endif">
                                        {{ $proyecto->estado_nombre }}
                                    </span>
                                    <a href="{{ route('proyectos.show', $proyecto) }}" class="text-red-400 hover:text-red-300 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <p class="text-gray-400">No tienes proyectos registrados</p>
                        <p class="text-gray-500 text-sm mt-2">¡Comienza creando tu primer proyecto!</p>
                        <a href="{{ route('proyectos.create') }}" class="inline-block mt-4 px-6 py-2 bg-gradient-to-r from-red-600 to-black text-white rounded-lg font-medium hover:from-red-700 hover:to-gray-900 transition-all duration-300 border border-red-500/30">
                            Crear Proyecto
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
