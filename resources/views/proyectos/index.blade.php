<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Gestión de Proyectos') }}
            </h2>
            <a href="{{ route('proyectos.create') }}" class="px-4 py-2 bg-gradient-to-r from-red-600 to-black text-white rounded-lg font-medium hover:from-red-700 hover:to-gray-900 transition-all duration-300 border border-red-500/30">
                Crear Proyecto
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-600/20 border border-green-500/30 rounded-lg backdrop-blur-sm">
                    <p class="text-green-300">{{ session('success') }}</p>
                </div>
            @endif

            @if(auth()->user()->es_admin && $usuarios->count() > 0)
                <!-- Filtro de Usuario -->
                <div class="mb-6 glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm p-6">
                    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                        <label class="text-sm font-medium text-gray-300 whitespace-nowrap">
                            Filtrar por usuario:
                        </label>
                        <select id="userFilter" class="bg-black/40 border border-red-500/30 text-white rounded-lg px-4 py-2 focus:ring-red-500 focus:border-red-500 backdrop-blur-sm">
                            <option value="">Todos los usuarios</option>
                            <option value="sin_asignar" {{ !auth()->user()->visible ? 'selected' : '' }}>Sin asignar</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ $usuario->id == auth()->id() ? 'selected' : '' }}>{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                        <button id="clearFilter" class="px-4 py-2 bg-gray-600/20 text-gray-300 rounded-lg hover:bg-gray-600/30 transition-colors duration-200 border border-gray-500/30 text-sm">
                            Limpiar filtro
                        </button>
                    </div>
                </div>
            @endif

            <div class="glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm overflow-hidden">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full" id="proyectosTable">
                            <thead>
                                <tr class="border-b border-red-500/20">
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Cliente</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Usuario</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Descripción</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Detalles del Proyecto</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-red-500/20" id="proyectosTableBody">
                                @forelse($proyectos as $proyecto)
                                    <tr class="hover:bg-black/30 transition-colors duration-200 proyecto-row" 
                                        data-user-id="{{ $proyecto->user_id ?? 'sin_asignar' }}"
                                        data-user-name="{{ $proyecto->user ? strtolower($proyecto->user->name) : 'sin asignar' }}">
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-white font-medium">
                                            {{ $proyecto->cliente }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{ $proyecto->user ? $proyecto->user->name : 'Sin asignar' }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-300 max-w-xs">
                                            <div class="truncate">{{ $proyecto->descripcion }}</div>
                                        </td>
                                        <td class="px-4 py-4 text-sm">
                                            <div class="space-y-2">
                                                <!-- Estado -->
                                                <div class="flex items-center gap-2">
                                                    <span class="text-xs text-gray-400 min-w-[50px]">Estado:</span>
                                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                                        @if($proyecto->estado === 'completado') bg-green-600/20 text-green-300
                                                        @elseif($proyecto->estado === 'en_progreso') bg-blue-600/20 text-blue-300
                                                        @elseif($proyecto->estado === 'pausado') bg-yellow-600/20 text-yellow-300
                                                        @elseif($proyecto->estado === 'cancelado') bg-red-600/20 text-red-300
                                                        @else bg-gray-600/20 text-gray-300
                                                        @endif">
                                                        {{ $proyecto->estado_nombre }}
                                                    </span>
                                                </div>
                                                
                                                <!-- Total y Saldo -->
                                                <div class="flex items-center gap-2">
                                                    <span class="text-xs text-gray-400 min-w-[50px]">Total:</span>
                                                    <span class="text-white font-medium">${{ number_format($proyecto->total, 2) }}</span>
                                                </div>
                                                
                                                <div class="flex items-center gap-2">
                                                    <span class="text-xs text-gray-400 min-w-[50px]">Saldo:</span>
                                                    @php
                                                        $saldo = $proyecto->saldo_pendiente;
                                                    @endphp
                                                    <span class="font-medium
                                                        @if($saldo > 0) text-red-300
                                                        @elseif($saldo == 0) text-green-300
                                                        @else text-orange-300
                                                        @endif">
                                                        ${{ number_format($saldo, 2) }}
                                                        @if($saldo > 0)
                                                            <span class="text-xs text-gray-400">(Pendiente)</span>
                                                        @elseif($saldo == 0)
                                                            <span class="text-xs text-gray-400">(Pagado)</span>
                                                        @else
                                                            <span class="text-xs text-gray-400">(Sobrepago)</span>
                                                        @endif
                                                    </span>
                                                </div>
                                                
                                                <!-- Sesiones -->
                                                <div class="flex items-center gap-2">
                                                    <span class="text-xs text-gray-400 min-w-[50px]">Sesiones:</span>
                                                    <span class="text-gray-300">{{ $proyecto->sesiones }}</span>
                                                </div>
                                                
                                                <!-- Fecha de Inicio -->
                                                <div class="flex items-center gap-2">
                                                    <span class="text-xs text-gray-400 min-w-[50px]">Inicio:</span>
                                                    <span class="text-gray-300">{{ $proyecto->fecha_inicio ? $proyecto->fecha_inicio->format('d/m/Y') : 'No definida' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <div class="flex flex-wrap gap-2">
                                                <a href="{{ route('proyectos.show', $proyecto) }}" class="inline-flex items-center px-3 py-1 bg-blue-600/20 text-blue-300 rounded-md hover:bg-blue-600/30 transition-colors duration-200 border border-blue-500/30">
                                                    Ver
                                                </a>
                                                
                                                <!-- Botón Galería -->
                                                <button onclick="abrirGaleriaModal({{ $proyecto->id }})" class="inline-flex items-center px-3 py-1 bg-purple-600/20 text-purple-300 rounded-md hover:bg-purple-600/30 transition-colors duration-200 border border-purple-500/30" title="Ver galería del proyecto">
                                                    Galería
                                                </button>
                                                
                                                @if(auth()->user()->es_admin || $proyecto->user_id === auth()->id())
                                                    <a href="{{ route('proyectos.edit', $proyecto) }}" class="inline-flex items-center px-3 py-1 bg-yellow-600/20 text-yellow-300 rounded-md hover:bg-yellow-600/30 transition-colors duration-200 border border-yellow-500/30">
                                                        Editar
                                                    </a>
                                                    
                                                    <!-- Botones de cambio de estado -->
                                                    @if($proyecto->estado === 'pendiente')
                                                        <form action="{{ route('proyectos.cambiar-estado', $proyecto) }}" method="POST" class="inline-block">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="estado" value="en_progreso">
                                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-green-600/20 text-green-300 rounded-md hover:bg-green-600/30 transition-colors duration-200 border border-green-500/30" title="Iniciar proyecto">
                                                                Iniciar
                                                            </button>
                                                        </form>
                                                    @elseif($proyecto->estado === 'en_progreso')
                                                        <form action="{{ route('proyectos.cambiar-estado', $proyecto) }}" method="POST" class="inline-block">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="estado" value="completado">
                                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-green-600/20 text-green-300 rounded-md hover:bg-green-600/30 transition-colors duration-200 border border-green-500/30" title="Marcar como completado">
                                                                Completar
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('proyectos.cambiar-estado', $proyecto) }}" method="POST" class="inline-block">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="estado" value="pausado">
                                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-orange-600/20 text-orange-300 rounded-md hover:bg-orange-600/30 transition-colors duration-200 border border-orange-500/30" title="Pausar proyecto">
                                                                Pausar
                                                            </button>
                                                        </form>
                                                    @elseif($proyecto->estado === 'pausado')
                                                        <form action="{{ route('proyectos.cambiar-estado', $proyecto) }}" method="POST" class="inline-block">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="estado" value="en_progreso">
                                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-blue-600/20 text-blue-300 rounded-md hover:bg-blue-600/30 transition-colors duration-200 border border-blue-500/30" title="Reanudar proyecto">
                                                                Reanudar
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('proyectos.cambiar-estado', $proyecto) }}" method="POST" class="inline-block">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="estado" value="cancelado">
                                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600/20 text-red-300 rounded-md hover:bg-red-600/30 transition-colors duration-200 border border-red-500/30" title="Cancelar proyecto" onclick="return confirm('¿Estás seguro de cancelar este proyecto?')">
                                                                Cancelar
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                                
                                                @if($proyecto->saldo_pendiente > 0)
                                                    <a href="{{ route('pagos.create', ['proyecto_id' => $proyecto->id]) }}" class="inline-flex items-center px-3 py-1 bg-cyan-600/20 text-cyan-300 rounded-md hover:bg-cyan-600/30 transition-colors duration-200 border border-cyan-500/30" title="Agregar pago para este proyecto">
                                                        Pago
                                                    </a>
                                                @endif
                                                
                                                @if(auth()->user()->es_admin || $proyecto->user_id === auth()->id())
                                                    <form action="{{ route('proyectos.destroy', $proyecto) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este proyecto?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600/20 text-red-300 rounded-md hover:bg-red-600/30 transition-colors duration-200 border border-red-500/30">
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-8 text-center text-gray-400">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                                </svg>
                                                <p>No hay proyectos registrados</p>
                                                <a href="{{ route('proyectos.create') }}" class="mt-2 text-red-400 hover:text-red-300">
                                                    Crear el primer proyecto
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($proyectos->hasPages())
                        <div class="mt-6">
                            {{ $proyectos->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para la galería -->
    <div id="galeriaModal" class="fixed inset-0 bg-black bg-opacity-75 backdrop-blur-sm hidden z-50 p-4" style="align-items: center; justify-content: center;">
        <div class="glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/40 backdrop-blur-sm max-w-6xl max-h-[90vh] w-full overflow-hidden">
            <!-- Header del modal -->
            <div class="p-6 border-b border-red-500/20">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-semibold text-white" id="modalTitulo">Galería del Proyecto</h3>
                        <p class="text-gray-300 text-sm" id="modalSubtitulo">Cliente: <span id="modalCliente"></span></p>
                    </div>
                    <button onclick="cerrarGaleriaModal()" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Contenido del modal -->
            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <div id="galeriaContenido" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Las imágenes se cargarán aquí dinámicamente -->
                </div>
                
                <!-- Mensaje cuando no hay imágenes -->
                <div id="sinImagenes" class="text-center py-12 hidden">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-gray-400 text-lg">No hay imágenes para este proyecto</p>
                    <p class="text-gray-500 text-sm mt-2">Las imágenes aparecerán aquí cuando se suban al proyecto</p>
                </div>
                
                <!-- Loading spinner -->
                <div id="loadingSpinner" class="text-center py-12 hidden">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-red-500"></div>
                    <p class="text-gray-400 mt-2">Cargando imágenes...</p>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->es_admin && $usuarios->count() > 0)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userFilter = document.getElementById('userFilter');
            const clearFilter = document.getElementById('clearFilter');
            const proyectoRows = document.querySelectorAll('.proyecto-row');
            
            function filterProjects() {
                const selectedUserId = userFilter.value;
                let visibleCount = 0;
                
                proyectoRows.forEach(row => {
                    const rowUserId = row.getAttribute('data-user-id');
                    
                    if (selectedUserId === '' || rowUserId === selectedUserId) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                // Mostrar mensaje si no hay resultados
                updateEmptyState(visibleCount === 0);
            }
            
            function updateEmptyState(isEmpty) {
                const tbody = document.getElementById('proyectosTableBody');
                let emptyRow = document.getElementById('empty-filter-row');
                
                if (isEmpty && userFilter.value !== '') {
                    // Crear mensaje de "no hay resultados" si no existe
                    if (!emptyRow) {
                        emptyRow = document.createElement('tr');
                        emptyRow.id = 'empty-filter-row';
                        emptyRow.innerHTML = `
                            <td colspan="5" class="px-4 py-8 text-center text-gray-400">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <p>No se encontraron proyectos para el usuario seleccionado</p>
                                    <button onclick="document.getElementById('clearFilter').click()" class="mt-2 text-red-400 hover:text-red-300 cursor-pointer">
                                        Limpiar filtro
                                    </button>
                                </div>
                            </td>
                        `;
                        tbody.appendChild(emptyRow);
                    }
                    emptyRow.style.display = '';
                } else if (emptyRow) {
                    emptyRow.style.display = 'none';
                }
            }
            
            // Event listeners
            userFilter.addEventListener('change', filterProjects);
            
            clearFilter.addEventListener('click', function() {
                userFilter.value = '';
                filterProjects();
            });
            
            // Aplicar filtro inicial al cargar la página
            filterProjects();
        });
    </script>
    @endif

    <!-- JavaScript para el modal de galería -->
    <script>
        let galeriaModalActual = null;
        
        async function abrirGaleriaModal(proyectoId) {
            const modal = document.getElementById('galeriaModal');
            const contenido = document.getElementById('galeriaContenido');
            const sinImagenes = document.getElementById('sinImagenes');
            const loading = document.getElementById('loadingSpinner');
            const modalCliente = document.getElementById('modalCliente');
            
            // Mostrar modal y loading
            modal.classList.remove('hidden');
            modal.style.display = 'flex';
            loading.classList.remove('hidden');
            contenido.innerHTML = '';
            sinImagenes.classList.add('hidden');
            
            try {
                const response = await fetch(`/proyectos/${proyectoId}/galeria`);
                const data = await response.json();
                
                if (data.success) {
                    // Actualizar información del proyecto
                    modalCliente.textContent = data.proyecto.cliente;
                    
                    // Ocultar loading
                    loading.classList.add('hidden');
                    
                    if (data.imagenes && data.imagenes.length > 0) {
                        // Mostrar imágenes
                        contenido.innerHTML = data.imagenes.map(imagen => `
                            <div class="relative group overflow-hidden rounded-lg border border-red-500/20 bg-black/20">
                                <img src="${imagen.ruta}" 
                                     alt="${imagen.descripcion || imagen.nombre_original}" 
                                     class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105 cursor-pointer"
                                     onclick="verImagenCompleta('${imagen.ruta}', '${imagen.descripcion || imagen.nombre_original}')">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-3 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                    <p class="text-white text-sm font-medium">${imagen.tipo}</p>
                                    ${imagen.descripcion ? `<p class="text-gray-300 text-xs mt-1">${imagen.descripcion}</p>` : ''}
                                </div>
                            </div>
                        `).join('');
                    } else {
                        // Mostrar mensaje de sin imágenes
                        sinImagenes.classList.remove('hidden');
                    }
                } else {
                    throw new Error('Error al cargar las imágenes');
                }
            } catch (error) {
                console.error('Error:', error);
                loading.classList.add('hidden');
                contenido.innerHTML = `
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 mx-auto mb-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-red-400 text-lg">Error al cargar las imágenes</p>
                        <p class="text-gray-500 text-sm mt-2">Por favor, inténtalo de nuevo más tarde</p>
                    </div>
                `;
            }
            
            galeriaModalActual = proyectoId;
        }
        
        function cerrarGaleriaModal() {
            const modal = document.getElementById('galeriaModal');
            modal.classList.add('hidden');
            modal.style.display = 'none';
            galeriaModalActual = null;
        }
        
        function verImagenCompleta(rutaImagen, descripcion) {
            // Crear un modal temporal para ver la imagen en tamaño completo
            const modalCompleto = document.createElement('div');
            modalCompleto.className = 'fixed inset-0 bg-black bg-opacity-90 z-[60] p-4';
            modalCompleto.style.display = 'flex';
            modalCompleto.style.alignItems = 'center';
            modalCompleto.style.justifyContent = 'center';
            modalCompleto.onclick = () => modalCompleto.remove();
            
            modalCompleto.innerHTML = `
                <div class="max-w-full max-h-full relative">
                    <img src="${rutaImagen}" alt="${descripcion}" class="max-w-full max-h-full object-contain">
                    <button onclick="event.stopPropagation(); this.parentElement.parentElement.remove()" 
                            class="absolute top-4 right-4 text-white bg-black/50 rounded-full p-2 hover:bg-black/70 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    ${descripcion ? `<div class="absolute bottom-4 left-4 right-4 text-center"><p class="text-white bg-black/50 rounded px-3 py-2">${descripcion}</p></div>` : ''}
                </div>
            `;
            
            document.body.appendChild(modalCompleto);
        }
        
        // Cerrar modal con Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && galeriaModalActual !== null) {
                cerrarGaleriaModal();
            }
        });
        
        // Cerrar modal al hacer clic fuera del contenido
        document.getElementById('galeriaModal').addEventListener('click', function(e) {
            if (e.target === this) {
                cerrarGaleriaModal();
            }
        });
    </script>
</x-app-layout>
