<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Galería de Imágenes') }}
            </h2>
            <p class="text-gray-300">Explora todas las imágenes de referencia y trabajos realizados</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Filtros y Búsqueda -->
            <div class="glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm overflow-hidden p-8 mb-8">
                <form method="GET" action="{{ route('galeria.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Búsqueda -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-white mb-2">Buscar</label>
                        <input type="text" 
                               id="search" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Cliente, descripción..."
                               class="w-full px-3 py-2 bg-black/30 border border-red-500/30 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>

                    <!-- Filtro por Tipo -->
                    <div>
                        <label for="tipo" class="block text-sm font-medium text-white mb-2">Tipo</label>
                        <select name="tipo" 
                                id="tipo"
                                class="w-full px-3 py-2 bg-black/30 border border-red-500/30 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">Todos los tipos</option>
                            <option value="referencia" {{ request('tipo') == 'referencia' ? 'selected' : '' }}>Referencia</option>
                            <option value="proceso" {{ request('tipo') == 'proceso' ? 'selected' : '' }}>Proceso</option>
                            <option value="resultado" {{ request('tipo') == 'resultado' ? 'selected' : '' }}>Resultado</option>
                        </select>
                    </div>

                    <!-- Filtro por Proyecto -->
                    <div>
                        <label for="proyecto" class="block text-sm font-medium text-white mb-2">Proyecto</label>
                        <select name="proyecto" 
                                id="proyecto"
                                class="w-full px-3 py-2 bg-black/30 border border-red-500/30 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">Todos los proyectos</option>
                            @foreach($proyectos as $proyecto)
                                <option value="{{ $proyecto->id }}" {{ request('proyecto') == $proyecto->id ? 'selected' : '' }}>
                                    {{ $proyecto->cliente }} - {{ Str::limit($proyecto->descripcion, 50) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="flex items-end space-x-2">
                        <button type="submit" 
                                class="px-4 py-2 bg-gradient-to-r from-red-600 to-black text-white rounded-md hover:from-red-700 hover:to-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors border border-red-500/30">
                            Filtrar
                        </button>
                        <a href="{{ route('galeria.index') }}" 
                           class="px-4 py-2 bg-gray-600/20 text-gray-300 rounded-md hover:bg-gray-600/30 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors border border-gray-500/30">
                            Limpiar
                        </a>
                    </div>
                </form>
            </div>

            <!-- Información de resultados -->
            <div class="flex justify-between items-center mb-6">
                <div class="text-white">
                    Mostrando {{ $imagenes->firstItem() ?? 0 }} - {{ $imagenes->lastItem() ?? 0 }} de {{ $imagenes->total() }} imágenes
                </div>
                <div class="text-sm text-gray-400">
                    {{ $imagenes->count() }} imágenes en esta página
                </div>
            </div>

            @if($imagenes->count() > 0)
                <!-- Grid de imágenes -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-8">
                    @foreach($imagenes as $imagen)
                        <div class="group relative aspect-square bg-black/20 rounded-lg overflow-hidden border border-red-500/20 hover:border-red-400 transition-all duration-300">
                            <a href="{{ route('galeria.show', $imagen) }}" 
                               class="block w-full h-full">
                                @if($imagen->exists)
                                    <img src="{{ $imagen->url }}" 
                                         alt="{{ $imagen->descripcion }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-500">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Overlay con información -->
                                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                    <div class="p-3 w-full">
                                        <!-- Tipo badge -->
                                        <div class="mb-2">
                                            @if($imagen->tipo === 'referencia')
                                                <span class="inline-block px-2 py-1 text-xs font-semibold bg-blue-600 text-white rounded">
                                                    Referencia
                                                </span>
                                            @elseif($imagen->tipo === 'proceso')
                                                <span class="inline-block px-2 py-1 text-xs font-semibold bg-yellow-600 text-white rounded">
                                                    Proceso
                                                </span>
                                            @else
                                                <span class="inline-block px-2 py-1 text-xs font-semibold bg-green-600 text-white rounded">
                                                    Resultado
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <!-- Cliente del proyecto -->
                                        <p class="text-white font-medium text-sm mb-1">
                                            {{ $imagen->proyecto->cliente }}
                                        </p>
                                        
                                        <!-- Descripción -->
                                        @if($imagen->descripcion)
                                            <p class="text-gray-300 text-xs">
                                                {{ Str::limit($imagen->descripcion, 50) }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="flex justify-center">
                    {{ $imagenes->links() }}
                </div>
            @else
                <!-- Estado vacío -->
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-300">No hay imágenes</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        @if(request()->hasAny(['search', 'tipo', 'proyecto']))
                            No se encontraron imágenes que coincidan con los filtros aplicados.
                        @else
                            Aún no se han subido imágenes a la galería.
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'tipo', 'proyecto']))
                        <div class="mt-6">
                            <a href="{{ route('galeria.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                                Limpiar filtros
                            </a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Estilos para la paginación de Laravel */
        .pagination {
            @apply flex justify-center space-x-1;
        }
        
        .pagination .page-link {
            @apply px-3 py-2 text-sm text-gray-300 bg-gray-800 border border-gray-700 hover:bg-gray-700 hover:text-white transition-colors;
        }
        
        .pagination .page-item.active .page-link {
            @apply bg-red-600 text-white border-red-600;
        }
        
        .pagination .page-item.disabled .page-link {
            @apply text-gray-500 cursor-not-allowed;
        }
        
        .pagination .page-link:first-child {
            @apply rounded-l-md;
        }
        
        .pagination .page-link:last-child {
            @apply rounded-r-md;
        }
    </style>
</x-app-layout>
