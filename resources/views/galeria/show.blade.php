<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Detalle de Imagen') }} - {{ $imagen->proyecto->cliente }}
            </h2>
            <a href="{{ route('galeria.index') }}" 
               class="px-4 py-2 bg-gray-600/20 text-gray-300 rounded-lg font-medium hover:bg-gray-600/30 transition-all duration-300 border border-gray-500/30">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Volver a la galería
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Imagen principal -->
                <div class="lg:col-span-2">
                    <div class="glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm overflow-hidden">
                        @if($imagen->exists)
                            <img src="{{ $imagen->url }}" 
                                 alt="{{ $imagen->descripcion }}"
                                 class="w-full h-auto max-h-[80vh] object-contain bg-black">
                        @else
                            <div class="w-full h-96 flex items-center justify-center text-gray-500 bg-gray-800">
                                <div class="text-center">
                                    <svg class="mx-auto w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-lg font-medium">Imagen no encontrada</p>
                                    <p class="text-sm">El archivo no existe en el servidor</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Información de la imagen -->
                <div class="space-y-6">
                    <!-- Información básica -->
                    <div class="glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm p-8">
                        <h1 class="text-2xl font-bold text-red-400 mb-4">Detalles de la Imagen</h1>
                        
                        <!-- Tipo -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-white mb-2">Tipo</label>
                            @if($imagen->tipo === 'referencia')
                                <span class="inline-block px-3 py-1 text-sm font-semibold bg-blue-600 text-white rounded-full">
                                    📋 Referencia
                                </span>
                            @elseif($imagen->tipo === 'proceso')
                                <span class="inline-block px-3 py-1 text-sm font-semibold bg-yellow-600 text-white rounded-full">
                                    🎨 Proceso
                                </span>
                            @else
                                <span class="inline-block px-3 py-1 text-sm font-semibold bg-green-600 text-white rounded-full">
                                    ✅ Resultado
                                </span>
                            @endif
                        </div>

                        <!-- Descripción -->
                        @if($imagen->descripcion)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-white mb-2">Descripción</label>
                                <p class="text-gray-200 bg-black/30 rounded-lg p-3 border border-red-500/30">
                                    {{ $imagen->descripcion }}
                                </p>
                            </div>
                        @endif

                        <!-- Fecha de subida -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-white mb-2">Fecha de subida</label>
                            <p class="text-gray-200">
                                {{ $imagen->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>

                        <!-- Información del archivo -->
                        @if($imagen->exists)
                            <div>
                                <label class="block text-sm font-medium text-white mb-2">Información del archivo</label>
                                <div class="bg-black/30 rounded-lg p-3 space-y-1 text-sm border border-red-500/30">
                                    <p class="text-gray-300">
                                        <span class="font-medium">Nombre:</span> 
                                        {{ basename($imagen->ruta) }}
                                    </p>
                                    <p class="text-gray-300">
                                        <span class="font-medium">Tamaño:</span> 
                                        {{ $imagen->file_size }}
                                    </p>
                                    <p class="text-gray-300">
                                        <span class="font-medium">Extensión:</span> 
                                        {{ $imagen->extension }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Información del proyecto -->
                    <div class="glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm p-8">
                        <h2 class="text-xl font-bold text-red-400 mb-4">Proyecto Relacionado</h2>
                        
                        <div class="space-y-4">
                            <!-- Cliente -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Cliente</label>
                                <p class="text-lg font-semibold text-white">
                                    {{ $imagen->proyecto->cliente }}
                                </p>
                            </div>

                            <!-- Descripción del proyecto -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Descripción</label>
                                <p class="text-gray-200">
                                    {{ $imagen->proyecto->descripcion }}
                                </p>
                            </div>

                            <!-- Estado -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Estado</label>
                                @php
                                    $estadoClasses = [
                                        'presupuesto' => 'bg-blue-600',
                                        'aprobado' => 'bg-green-600',
                                        'en_proceso' => 'bg-yellow-600',
                                        'completado' => 'bg-purple-600',
                                        'cancelado' => 'bg-red-600'
                                    ];
                                    $estadoTexts = [
                                        'presupuesto' => 'Presupuesto',
                                        'aprobado' => 'Aprobado',
                                        'en_proceso' => 'En Proceso',
                                        'completado' => 'Completado',
                                        'cancelado' => 'Cancelado'
                                    ];
                                @endphp
                                <span class="inline-block px-3 py-1 text-sm font-semibold text-white rounded-full {{ $estadoClasses[$imagen->proyecto->estado] ?? 'bg-gray-600' }}">
                                    {{ $estadoTexts[$imagen->proyecto->estado] ?? ucfirst($imagen->proyecto->estado) }}
                                </span>
                            </div>

                            <!-- Botón para ver proyecto -->
                            <div class="pt-2">
                                <a href="{{ route('proyectos.show', $imagen->proyecto) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-600 to-black text-white rounded-md hover:from-red-700 hover:to-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors border border-red-500/30">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Ver proyecto completo
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm p-8">
                        <h2 class="text-xl font-bold text-red-400 mb-4">Acciones</h2>
                        
                        <div class="space-y-3">
                            <!-- Ver imágenes del proyecto -->
                            <a href="{{ route('proyectos.imagenes.index', $imagen->proyecto) }}" 
                               class="block w-full px-4 py-2 bg-blue-600/20 text-blue-300 text-center rounded-md hover:bg-blue-600/30 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors border border-blue-500/30">
                                Ver todas las imágenes del proyecto
                            </a>

                            <!-- Descargar imagen (si existe) -->
                            @if($imagen->exists)
                                <a href="{{ $imagen->url }}" 
                                   download="{{ basename($imagen->ruta) }}"
                                   class="block w-full px-4 py-2 bg-green-600/20 text-green-300 text-center rounded-md hover:bg-green-600/30 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors border border-green-500/30">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Descargar imagen
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
