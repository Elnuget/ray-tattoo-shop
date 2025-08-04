<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Imágenes del Proyecto') }}: {{ $proyecto->cliente }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('proyectos.imagenes.create', $proyecto) }}" class="px-4 py-2 bg-gradient-to-r from-red-600 to-black text-white rounded-lg font-medium hover:from-red-700 hover:to-gray-900 transition-all duration-300 border border-red-500/30">
                    Subir Imágenes
                </a>
                <a href="{{ route('proyectos.show', $proyecto) }}" class="px-4 py-2 bg-gray-600/20 text-gray-300 rounded-lg font-medium hover:bg-gray-600/30 transition-all duration-300 border border-gray-500/30">
                    Volver al Proyecto
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-600/20 border border-green-500/30 rounded-lg backdrop-blur-sm">
                    <p class="text-green-300">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Filtros -->
            <div class="mb-6 glass rounded-xl p-4 border border-red-500/20 bg-black/20 backdrop-blur-sm">
                <div class="flex flex-wrap gap-4 items-center">
                    <span class="text-white font-medium">Filtrar por tipo:</span>
                    <div class="flex gap-2">
                        <button onclick="filterImages('all')" class="filter-btn active px-3 py-1 bg-red-600/20 text-red-300 rounded-md border border-red-500/30 hover:bg-red-600/30 transition-colors duration-200">
                            Todas ({{ $imagenes->count() }})
                        </button>
                        <button onclick="filterImages('referencia')" class="filter-btn px-3 py-1 bg-blue-600/20 text-blue-300 rounded-md border border-blue-500/30 hover:bg-blue-600/30 transition-colors duration-200">
                            Referencias ({{ $imagenes->where('tipo', 'referencia')->count() }})
                        </button>
                        <button onclick="filterImages('tattoo')" class="filter-btn px-3 py-1 bg-green-600/20 text-green-300 rounded-md border border-green-500/30 hover:bg-green-600/30 transition-colors duration-200">
                            Tatuajes ({{ $imagenes->where('tipo', 'tattoo')->count() }})
                        </button>
                    </div>
                </div>
            </div>

            @if($imagenes->count() > 0)
                <!-- Grid de imágenes -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="images-grid">
                    @foreach($imagenes as $imagen)
                        <div class="imagen-item glass rounded-xl overflow-hidden border border-red-500/20 bg-black/20 backdrop-blur-sm hover:border-red-400/40 transition-all duration-300" data-tipo="{{ $imagen->tipo }}">
                            <!-- Imagen -->
                            <div class="aspect-square relative group">
                                <img src="{{ $imagen->url }}" 
                                     alt="{{ $imagen->nombre_original }}" 
                                     class="w-full h-full object-cover">
                                
                                <!-- Overlay con acciones -->
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <div class="flex space-x-2">
                                        <button onclick="openImageModal('{{ $imagen->url }}', '{{ $imagen->nombre_original }}')" 
                                                class="p-2 bg-blue-600/80 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                        <a href="{{ route('proyectos.imagenes.edit', [$proyecto, $imagen]) }}" 
                                           class="p-2 bg-yellow-600/80 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('proyectos.imagenes.destroy', [$proyecto, $imagen]) }}" 
                                              method="POST" 
                                              class="inline-block"
                                              onsubmit="return confirm('¿Estás seguro de eliminar esta imagen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-600/80 text-white rounded-lg hover:bg-red-600 transition-colors duration-200">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Badge de tipo -->
                                <div class="absolute top-2 left-2">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                        @if($imagen->tipo === 'referencia') bg-blue-600/80 text-blue-100
                                        @else bg-green-600/80 text-green-100
                                        @endif">
                                        {{ $imagen->tipo_nombre }}
                                    </span>
                                </div>
                            </div>

                            <!-- Información -->
                            <div class="p-4">
                                <h3 class="text-white font-medium truncate mb-1">{{ $imagen->nombre_original }}</h3>
                                
                                @if($imagen->descripcion)
                                    <p class="text-gray-300 text-sm mb-2 line-clamp-2">{{ $imagen->descripcion }}</p>
                                @endif
                                
                                <div class="flex justify-between items-center text-xs text-gray-400">
                                    <span>{{ $imagen->tamaño_formateado }}</span>
                                    <span>{{ $imagen->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Estado vacío -->
                <div class="glass rounded-xl p-8 border border-red-500/20 bg-black/20 backdrop-blur-sm text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-white mb-2">No hay imágenes</h3>
                    <p class="text-gray-400 mb-4">Este proyecto aún no tiene imágenes asociadas.</p>
                    <a href="{{ route('proyectos.imagenes.create', $proyecto) }}" 
                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-600 to-black text-white rounded-lg font-medium hover:from-red-700 hover:to-gray-900 transition-all duration-300 border border-red-500/30">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Subir primera imagen
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal para vista de imagen -->
    <div id="imageModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white bg-black/50 rounded-full p-2 hover:bg-black/70 transition-colors duration-200 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
        </div>
    </div>

    <script>
        function filterImages(tipo) {
            const items = document.querySelectorAll('.imagen-item');
            const buttons = document.querySelectorAll('.filter-btn');
            
            // Actualizar botones
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            // Filtrar imágenes
            items.forEach(item => {
                if (tipo === 'all' || item.dataset.tipo === tipo) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function openImageModal(src, alt) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = src;
            modalImage.alt = alt;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Cerrar modal al hacer clic fuera de la imagen
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Cerrar modal con la tecla Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>

    <style>
        .filter-btn.active {
            background-color: rgb(220 38 38 / 0.3) !important;
            color: rgb(252 165 165) !important;
            border-color: rgb(220 38 38 / 0.5) !important;
        }
        
        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }
    </style>
</x-app-layout>
