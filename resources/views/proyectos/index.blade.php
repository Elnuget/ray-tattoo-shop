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
                                    <th class="hidden">ID</th> <!-- Columna oculta para el ID del proyecto -->
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
                                        data-proyecto-id="{{ $proyecto->id }}"
                                        data-user-id="{{ $proyecto->user_id ?? 'sin_asignar' }}"
                                        data-user-name="{{ $proyecto->user ? strtolower($proyecto->user->name) : 'sin asignar' }}"
                                        data-cliente="{{ $proyecto->cliente }}"
                                        data-descripcion="{{ $proyecto->descripcion }}"
                                        data-total="{{ $proyecto->total }}"
                                        data-saldo="{{ $proyecto->saldo_pendiente }}">
                                        <td class="hidden">{{ $proyecto->id }}</td> <!-- Columna oculta con el ID del proyecto -->
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
                                                    <span class="text-white font-medium">${{ number_format((float)$proyecto->total, 2) }}</span>
                                                </div>
                                                
                                                <div class="flex items-center gap-2">
                                                    <span class="text-xs text-gray-400 min-w-[50px]">Saldo:</span>
                                                    @php
                                                        $saldo = (float)$proyecto->saldo_pendiente;
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
                                                    <span class="text-gray-300">{{ $proyecto->fecha_inicio ? \Carbon\Carbon::parse($proyecto->fecha_inicio)->format('d/m/Y') : 'No definida' }}</span>
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
                                                    <!-- Enlace principal -->
                                                    <a href="{{ route('pagos.create-from-project', $proyecto) }}" 
                                                       class="inline-flex items-center px-3 py-1 bg-cyan-600/20 text-cyan-300 rounded-md hover:bg-cyan-600/30 transition-colors duration-200 border border-cyan-500/30" 
                                                       title="Agregar pago para este proyecto"
                                                       data-proyecto-id="{{ $proyecto->id }}"
                                                       data-cliente="{{ $proyecto->cliente }}"
                                                       data-saldo="{{ $proyecto->saldo_pendiente }}"
                                                       onclick="navegarAPago({{ $proyecto->id }}); return true;">
                                                        💰 Pagar
                                                    </a>
                                                    
                                                    <!-- Alternativa con formulario POST (comentado por ahora) -->
                                                    <!--
                                                    <form action="{{ route('pagos.create-from-project', $proyecto) }}" method="GET" class="inline-block">
                                                        <button type="submit" class="inline-flex items-center px-3 py-1 bg-cyan-600/20 text-cyan-300 rounded-md hover:bg-cyan-600/30 transition-colors duration-200 border border-cyan-500/30" 
                                                                title="Agregar pago para este proyecto">
                                                            💰 Pagar (Form)
                                                        </button>
                                                    </form>
                                                    -->
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
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white" id="modalTitulo">Galería del Proyecto</h3>
                        <p class="text-gray-300 text-sm" id="modalSubtitulo">Cliente: <span id="modalCliente"></span></p>
                        
                        <!-- Filtro por tipo y botón añadir -->
                        <div class="mt-4 flex flex-wrap items-center gap-3">
                            <label class="text-sm text-gray-300">Filtrar por tipo:</label>
                            <select id="filtroTipo" class="bg-black/40 border border-red-500/30 text-white rounded-lg px-3 py-1 text-sm focus:ring-red-500 focus:border-red-500">
                                <option value="">Todos los tipos</option>
                            </select>
                            <span class="text-xs text-gray-400" id="contadorImagenes"></span>
                            
                            <!-- Botón para añadir imagen -->
                            <button onclick="mostrarFormularioImagen()" class="ml-auto inline-flex items-center px-4 py-2 bg-green-600/20 text-green-300 rounded-lg hover:bg-green-600/30 transition-colors duration-200 border border-green-500/30">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Añadir Imagen
                            </button>
                        </div>
                    </div>
                    <button onclick="cerrarGaleriaModal()" class="text-gray-400 hover:text-white transition-colors ml-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Contenido del modal -->
            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <!-- Formulario para añadir imagen -->
                <div id="formularioImagen" class="hidden mb-6 p-4 border border-green-500/30 rounded-lg bg-green-600/10">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-medium text-white">Añadir Nueva Imagen</h4>
                        <button onclick="ocultarFormularioImagen()" class="text-gray-400 hover:text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <form id="formSubirImagen" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Archivo de imagen -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Imagen</label>
                                <input type="file" name="imagen" id="inputImagen" accept="image/*" required
                                       class="w-full bg-black/30 border border-red-500/30 text-white rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500">
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG, GIF, WEBP. Máximo 5MB</p>
                            </div>
                            
                            <!-- Tipo de imagen -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Tipo</label>
                                <select name="tipo" id="selectTipo" required
                                        class="w-full bg-black/30 border border-red-500/30 text-white rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500">
                                    <option value="">Seleccionar tipo</option>
                                    <option value="referencia">Imagen de Referencia</option>
                                    <option value="tattoo">Imagen del Tatuaje</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Descripción -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Descripción</label>
                            <textarea name="descripcion" id="textareaDescripcion" rows="3" 
                                      class="w-full bg-black/30 border border-red-500/30 text-white rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500"
                                      placeholder="Descripción opcional de la imagen..."></textarea>
                        </div>
                        
                        <!-- Botones -->
                        <div class="flex justify-end gap-3">
                            <button type="button" onclick="ocultarFormularioImagen()" 
                                    class="px-4 py-2 bg-gray-600/20 text-gray-300 rounded-lg hover:bg-gray-600/30 transition-colors">
                                Cancelar
                            </button>
                            <button type="submit" id="btnSubirImagen"
                                    class="px-4 py-2 bg-green-600/20 text-green-300 rounded-lg hover:bg-green-600/30 transition-colors border border-green-500/30">
                                <span class="btn-text">Subir Imagen</span>
                                <span class="btn-loading hidden">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-green-300 inline" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Subiendo...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
                
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
        let imagenesActuales = [];
        let tiposDisponibles = {};
        
        async function abrirGaleriaModal(proyectoId) {
            const modal = document.getElementById('galeriaModal');
            const contenido = document.getElementById('galeriaContenido');
            const sinImagenes = document.getElementById('sinImagenes');
            const loading = document.getElementById('loadingSpinner');
            const modalCliente = document.getElementById('modalCliente');
            const filtroTipo = document.getElementById('filtroTipo');
            const contadorImagenes = document.getElementById('contadorImagenes');
            
            // Mostrar modal y loading
            modal.classList.remove('hidden');
            modal.style.display = 'flex';
            loading.classList.remove('hidden');
            contenido.innerHTML = '';
            sinImagenes.classList.add('hidden');
            
            // Limpiar filtro
            filtroTipo.innerHTML = '<option value="">Todos los tipos</option>';
            contadorImagenes.textContent = '';
            
            try {
                const response = await fetch(`/proyectos/${proyectoId}/galeria`);
                const data = await response.json();
                
                if (data.success) {
                    // Guardar datos
                    imagenesActuales = data.imagenes;
                    tiposDisponibles = data.tipos;
                    
                    // Actualizar información del proyecto
                    modalCliente.textContent = data.proyecto.cliente;
                    
                    // Llenar filtro de tipos
                    const tiposEnImagenes = [...new Set(data.imagenes.map(img => img.tipo))];
                    tiposEnImagenes.forEach(tipo => {
                        const option = document.createElement('option');
                        option.value = tipo;
                        option.textContent = data.tipos[tipo] || tipo;
                        filtroTipo.appendChild(option);
                    });
                    
                    // Ocultar loading
                    loading.classList.add('hidden');
                    
                    if (data.imagenes && data.imagenes.length > 0) {
                        // Mostrar todas las imágenes inicialmente
                        mostrarImagenes(data.imagenes);
                        actualizarContador(data.imagenes);
                    } else {
                        // Mostrar mensaje de sin imágenes
                        sinImagenes.classList.remove('hidden');
                        contadorImagenes.textContent = '0 imágenes';
                    }
                } else {
                    throw new Error('Error al cargar las imágenes');
                }
            } catch (error) {
                console.error('Error:', error);
                loading.classList.add('hidden');
                mostrarError();
            }
            
            galeriaModalActual = proyectoId;
        }
        
        function mostrarImagenes(imagenes) {
            const contenido = document.getElementById('galeriaContenido');
            
            if (imagenes.length === 0) {
                contenido.innerHTML = `
                    <div class="col-span-full text-center py-8">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                        </svg>
                        <p class="text-gray-400">No hay imágenes de este tipo</p>
                    </div>
                `;
                return;
            }
            
            contenido.innerHTML = imagenes.map(imagen => {
                const tipoColor = imagen.tipo === 'referencia' ? 'bg-blue-600/80' : 'bg-purple-600/80';
                const descripcionTexto = imagen.descripcion && imagen.descripcion !== 'null' && imagen.descripcion !== '' ? imagen.descripcion : 'Sin descripción';
                const nombreArchivo = imagen.nombre_original && imagen.nombre_original !== 'null' ? imagen.nombre_original : 'imagen.jpg';
                
                return `
                    <div class="relative overflow-hidden rounded-lg border border-red-500/20 bg-black/20 hover:border-red-500/40 transition-all duration-300">
                        <!-- Imagen -->
                        <div class="aspect-square relative cursor-pointer" onclick="verImagenCompleta('${imagen.ruta}', '${descripcionTexto}', '${nombreArchivo}')">
                            <img src="${imagen.ruta}" 
                                 alt="${descripcionTexto}" 
                                 class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                                 loading="lazy">
                            
                            <!-- Badge del tipo -->
                            <div class="absolute top-2 left-2">
                                <span class="px-2 py-1 text-xs font-medium text-white rounded-full ${tipoColor}">
                                    ${imagen.tipo_nombre}
                                </span>
                            </div>
                            
                            <!-- Botón ver completa -->
                            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="bg-black/50 text-white p-1 rounded-full hover:bg-black/70 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Información de la imagen -->
                        <div class="p-3 space-y-2">
                            <!-- Nombre del archivo -->
                            <div class="flex items-start justify-between">
                                <h4 class="text-white text-sm font-medium truncate flex-1" title="${nombreArchivo}">
                                    ${nombreArchivo}
                                </h4>
                                <span class="text-xs text-gray-400 ml-2 shrink-0">${imagen.tipo_nombre}</span>
                            </div>
                            
                            <!-- Descripción -->
                            <div class="text-gray-300 text-xs">
                                <p class="line-clamp-2" title="${descripcionTexto}">
                                    ${descripcionTexto}
                                </p>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }
        
        function actualizarContador(imagenes) {
            const contadorImagenes = document.getElementById('contadorImagenes');
            const total = imagenes.length;
            const tipos = [...new Set(imagenes.map(img => img.tipo_nombre))];
            
            if (total === 1) {
                contadorImagenes.textContent = '1 imagen';
            } else {
                contadorImagenes.textContent = `${total} imágenes`;
            }
            
            if (tipos.length > 1) {
                contadorImagenes.textContent += ` (${tipos.join(', ')})`;
            }
        }
        
        function mostrarError() {
            const contenido = document.getElementById('galeriaContenido');
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
        
        // Filtrado por tipo
        document.getElementById('filtroTipo').addEventListener('change', function() {
            const tipoSeleccionado = this.value;
            let imagenesFiltradas;
            
            if (tipoSeleccionado === '') {
                imagenesFiltradas = imagenesActuales;
            } else {
                imagenesFiltradas = imagenesActuales.filter(img => img.tipo === tipoSeleccionado);
            }
            
            mostrarImagenes(imagenesFiltradas);
            actualizarContador(imagenesFiltradas);
        });
        
        function cerrarGaleriaModal() {
            const modal = document.getElementById('galeriaModal');
            modal.classList.add('hidden');
            modal.style.display = 'none';
            galeriaModalActual = null;
            imagenesActuales = [];
            tiposDisponibles = {};
            
            // Ocultar formulario si está abierto
            ocultarFormularioImagen();
        }
        
        function mostrarFormularioImagen() {
            const formulario = document.getElementById('formularioImagen');
            formulario.classList.remove('hidden');
            document.getElementById('inputImagen').focus();
        }
        
        function ocultarFormularioImagen() {
            const formulario = document.getElementById('formularioImagen');
            formulario.classList.add('hidden');
            
            // Limpiar formulario
            document.getElementById('formSubirImagen').reset();
        }
        
        // Manejar envío del formulario
        document.getElementById('formSubirImagen').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (galeriaModalActual === null) return;
            
            const formData = new FormData(this);
            const btnSubir = document.getElementById('btnSubirImagen');
            const btnText = btnSubir.querySelector('.btn-text');
            const btnLoading = btnSubir.querySelector('.btn-loading');
            
            // Mostrar loading
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
            btnSubir.disabled = true;
            
            try {
                const response = await fetch(`/proyectos/${galeriaModalActual}/imagenes/modal`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Agregar nueva imagen a la lista
                    imagenesActuales.push(data.imagen);
                    
                    // Actualizar la vista según el filtro actual
                    const filtroActual = document.getElementById('filtroTipo').value;
                    let imagenesFiltradas;
                    if (filtroActual === '') {
                        imagenesFiltradas = imagenesActuales;
                    } else {
                        imagenesFiltradas = imagenesActuales.filter(img => img.tipo === filtroActual);
                    }
                    
                    mostrarImagenes(imagenesFiltradas);
                    actualizarContador(imagenesFiltradas);
                    
                    // Ocultar formulario
                    ocultarFormularioImagen();
                    
                    // Mostrar mensaje de éxito
                    mostrarNotificacion('Imagen subida exitosamente', 'success');
                } else {
                    throw new Error(data.message || 'Error al subir la imagen');
                }
            } catch (error) {
                console.error('Error:', error);
                mostrarNotificacion('Error al subir la imagen: ' + error.message, 'error');
            } finally {
                // Ocultar loading
                btnText.classList.remove('hidden');
                btnLoading.classList.add('hidden');
                btnSubir.disabled = false;
            }
        });
        
        function mostrarNotificacion(mensaje, tipo) {
            // Crear notificación temporal
            const notificacion = document.createElement('div');
            notificacion.className = `fixed top-4 right-4 z-[70] px-4 py-3 rounded-lg shadow-lg transition-all duration-300 ${
                tipo === 'success' ? 'bg-green-600/90 text-white' : 'bg-red-600/90 text-white'
            }`;
            notificacion.textContent = mensaje;
            
            document.body.appendChild(notificacion);
            
            // Remover después de 3 segundos
            setTimeout(() => {
                notificacion.style.opacity = '0';
                notificacion.style.transform = 'translateX(100%)';
                setTimeout(() => notificacion.remove(), 300);
            }, 3000);
        }
        
        function verImagenCompleta(rutaImagen, descripcion, nombreArchivo) {
            // Crear un modal temporal para ver la imagen en tamaño completo
            const modalCompleto = document.createElement('div');
            modalCompleto.className = 'fixed inset-0 bg-black bg-opacity-95 z-[60] p-4';
            modalCompleto.style.display = 'flex';
            modalCompleto.style.alignItems = 'center';
            modalCompleto.style.justifyContent = 'center';
            modalCompleto.onclick = () => modalCompleto.remove();
            
            const descripcionMostrar = descripcion && descripcion !== 'undefined' && descripcion !== 'Sin descripción' ? descripcion : null;
            const nombreMostrar = nombreArchivo && nombreArchivo !== 'undefined' ? nombreArchivo : 'Imagen';
            
            modalCompleto.innerHTML = `
                <div class="max-w-full max-h-full relative">
                    <img src="${rutaImagen}" alt="${descripcionMostrar || nombreMostrar}" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
                    <button onclick="event.stopPropagation(); this.parentElement.parentElement.remove()" 
                            class="absolute top-4 right-4 text-white bg-black/70 rounded-full p-2 hover:bg-black/90 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <div class="absolute bottom-4 left-4 right-4 text-center">
                        <div class="bg-black/70 rounded-lg px-4 py-2 backdrop-blur-sm">
                            <p class="text-white font-medium">${nombreMostrar}</p>
                            ${descripcionMostrar ? `<p class="text-gray-300 text-sm mt-1">${descripcionMostrar}</p>` : ''}
                        </div>
                    </div>
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
        
        // Función para navegar a crear pago con proyecto específico
        function navegarAPago(proyectoId) {
            console.log('🚀 [Debug] Navegando a pago para proyecto:', proyectoId);
            
            // Guardar en sessionStorage como backup
            sessionStorage.setItem('proyecto_seleccionado_pago', proyectoId);
            
            // También intentar con localStorage
            localStorage.setItem('proyecto_seleccionado_pago', proyectoId);
            
            console.log('💾 [Debug] Guardado en storage:', proyectoId);
            
            // Continuar con la navegación normal (return true en onclick permite que el enlace funcione)
            return true;
        }
    </script>
</x-app-layout>
