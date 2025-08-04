<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Detalles del Proyecto') }}: {{ $proyecto->cliente }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('proyectos.edit', $proyecto) }}" class="px-4 py-2 bg-yellow-600/20 text-yellow-300 rounded-lg font-medium hover:bg-yellow-600/30 transition-all duration-300 border border-yellow-500/30">
                    Editar
                </a>
                <a href="{{ route('proyectos.index') }}" class="px-4 py-2 bg-gray-600/20 text-gray-300 rounded-lg font-medium hover:bg-gray-600/30 transition-all duration-300 border border-gray-500/30">
                    Volver al Listado
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Información Principal -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Información del Cliente -->
                    <div class="glass rounded-xl p-6 border border-red-500/20 bg-black/20 backdrop-blur-sm">
                        <h3 class="text-xl font-semibold text-white mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Información del Cliente
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <label class="text-sm font-medium text-gray-300">Cliente</label>
                                <p class="text-white text-lg">{{ $proyecto->cliente }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-300">Descripción del Tatuaje</label>
                                <p class="text-white">{{ $proyecto->descripcion }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Detalles Técnicos -->
                    <div class="glass rounded-xl p-6 border border-red-500/20 bg-black/20 backdrop-blur-sm">
                        <h3 class="text-xl font-semibold text-white mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Detalles Técnicos
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium text-gray-300">Ubicación</label>
                                <p class="text-white">{{ $proyecto->ubicacion_tatuaje ?: 'No especificada' }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-300">Tamaño</label>
                                <p class="text-white">{{ $proyecto->tamaño ?: 'No especificado' }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-300">Estilo</label>
                                <p class="text-white">{{ $proyecto->estilo ?: 'No especificado' }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-300">Sesiones</label>
                                <p class="text-white">{{ $proyecto->sesiones }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Notas -->
                    @if($proyecto->notas)
                        <div class="glass rounded-xl p-6 border border-red-500/20 bg-black/20 backdrop-blur-sm">
                            <h3 class="text-xl font-semibold text-white mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Notas y Observaciones
                            </h3>
                            <p class="text-gray-300">{{ $proyecto->notas }}</p>
                        </div>
                    @endif
                </div>

                <!-- Panel Lateral -->
                <div class="space-y-6">
                    <!-- Estado y Fechas -->
                    <div class="glass rounded-xl p-6 border border-red-500/20 bg-black/20 backdrop-blur-sm">
                        <h3 class="text-lg font-semibold text-white mb-4">Estado del Proyecto</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-medium text-gray-300">Estado Actual</label>
                                <div class="mt-1">
                                    <span class="px-3 py-1 text-sm font-medium rounded-full
                                        @if($proyecto->estado === 'completado') bg-green-600/20 text-green-300
                                        @elseif($proyecto->estado === 'en_progreso') bg-blue-600/20 text-blue-300
                                        @elseif($proyecto->estado === 'pausado') bg-yellow-600/20 text-yellow-300
                                        @elseif($proyecto->estado === 'cancelado') bg-red-600/20 text-red-300
                                        @else bg-gray-600/20 text-gray-300
                                        @endif">
                                        {{ $proyecto->estado_nombre }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-300">Fecha de Inicio</label>
                                <p class="text-white">{{ $proyecto->fecha_inicio ? $proyecto->fecha_inicio->format('d/m/Y') : 'No definida' }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-300">Fecha de Finalización</label>
                                <p class="text-white">{{ $proyecto->fecha_fin ? $proyecto->fecha_fin->format('d/m/Y') : 'No definida' }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-300">Fecha de Creación</label>
                                <p class="text-white">{{ $proyecto->created_at->format('d/m/Y H:i') }}</p>
                                <p class="text-gray-400 text-sm">{{ $proyecto->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Información Financiera -->
                    <div class="glass rounded-xl p-6 border border-red-500/20 bg-black/20 backdrop-blur-sm">
                        <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            Financiero
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-300">Precio Total:</span>
                                <span class="text-white font-semibold">${{ number_format($proyecto->total, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-300">Depósito:</span>
                                <span class="text-white">${{ number_format($proyecto->deposito, 2) }}</span>
                            </div>
                            <div class="border-t border-red-500/20 pt-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Saldo Pendiente:</span>
                                    <span class="text-red-400 font-semibold">${{ number_format($proyecto->saldo_pendiente, 2) }}</span>
                                </div>
                            </div>
                            @if($proyecto->precio_por_sesion)
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Precio por Sesión:</span>
                                    <span class="text-white">${{ number_format($proyecto->precio_por_sesion, 2) }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="glass rounded-xl p-6 border border-red-500/20 bg-black/20 backdrop-blur-sm">
                        <h3 class="text-lg font-semibold text-white mb-4">Acciones</h3>
                        <div class="space-y-3">
                            <a href="{{ route('proyectos.edit', $proyecto) }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-yellow-600/20 text-yellow-300 rounded-lg font-medium hover:bg-yellow-600/30 transition-all duration-300 border border-yellow-500/30">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Editar Proyecto
                            </a>
                            
                            <form action="{{ route('proyectos.destroy', $proyecto) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este proyecto? Esta acción no se puede deshacer.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600/20 text-red-300 rounded-lg font-medium hover:bg-red-600/30 transition-all duration-300 border border-red-500/30">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Eliminar Proyecto
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
