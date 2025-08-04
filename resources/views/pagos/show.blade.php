<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Detalles del Pago') }} #{{ $pago->id }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('pagos.edit', $pago) }}" class="px-4 py-2 bg-yellow-600/20 text-yellow-300 rounded-lg font-medium hover:bg-yellow-600/30 transition-all duration-300 border border-yellow-500/30">
                    Editar
                </a>
                <a href="{{ route('pagos.index') }}" class="px-4 py-2 bg-gray-600/20 text-gray-300 rounded-lg font-medium hover:bg-gray-600/30 transition-all duration-300 border border-gray-500/30">
                    Volver al Listado
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Información Principal del Pago -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Detalles del Pago -->
                    <div class="glass rounded-xl p-6 border border-red-500/20 bg-black/20 backdrop-blur-sm">
                        <h3 class="text-xl font-semibold text-white mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            Información del Pago
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium text-gray-300">Monto</label>
                                <p class="text-white text-2xl font-bold">${{ number_format($pago->monto, 2) }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-300">Método de Pago</label>
                                <p class="text-white">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        @if($pago->metodo === 'efectivo') bg-green-600/20 text-green-300
                                        @elseif($pago->metodo === 'transferencia') bg-blue-600/20 text-blue-300
                                        @elseif(str_contains($pago->metodo, 'tarjeta')) bg-purple-600/20 text-purple-300
                                        @else bg-gray-600/20 text-gray-300
                                        @endif">
                                        {{ $pago->metodo_nombre }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-300">Fecha del Pago</label>
                                <p class="text-white">{{ $pago->fecha_pago->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-300">Registrado</label>
                                <p class="text-white">{{ $pago->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        
                        @if($pago->descripcion)
                            <div class="mt-4 pt-4 border-t border-gray-600/30">
                                <label class="text-sm font-medium text-gray-300">Descripción</label>
                                <p class="text-white mt-1">{{ $pago->descripcion }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Información del Proyecto -->
                    <div class="glass rounded-xl p-6 border border-red-500/20 bg-black/20 backdrop-blur-sm">
                        <h3 class="text-xl font-semibold text-white mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Proyecto Asociado
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <label class="text-sm font-medium text-gray-300">Cliente</label>
                                <p class="text-white text-lg">{{ $pago->proyecto->cliente }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-300">Descripción del Tatuaje</label>
                                <p class="text-white">{{ $pago->proyecto->descripcion }}</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-300">Estado del Proyecto</label>
                                    <p class="text-white">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                            @if($pago->proyecto->estado === 'completado') bg-green-600/20 text-green-300
                                            @elseif($pago->proyecto->estado === 'en_progreso') bg-blue-600/20 text-blue-300
                                            @elseif($pago->proyecto->estado === 'pausado') bg-yellow-600/20 text-yellow-300
                                            @elseif($pago->proyecto->estado === 'cancelado') bg-red-600/20 text-red-300
                                            @else bg-gray-600/20 text-gray-300
                                            @endif">
                                            {{ $pago->proyecto->estado_nombre }}
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-300">Total del Proyecto</label>
                                    <p class="text-white font-bold">${{ number_format($pago->proyecto->total, 2) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-600/30">
                            <a href="{{ route('proyectos.show', $pago->proyecto) }}" class="inline-flex items-center px-4 py-2 bg-blue-600/20 text-blue-300 rounded-md hover:bg-blue-600/30 transition-colors duration-200 border border-blue-500/30">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Ver Proyecto Completo
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Panel de Resumen -->
                <div class="space-y-6">
                    <!-- Resumen Financiero del Proyecto -->
                    <div class="glass rounded-xl p-6 border border-red-500/20 bg-black/20 backdrop-blur-sm">
                        <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Resumen Financiero
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-600/30">
                                <span class="text-gray-300">Total del Proyecto:</span>
                                <span class="text-white font-medium">${{ number_format($pago->proyecto->total, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-600/30">
                                <span class="text-gray-300">Depósito Recibido:</span>
                                <span class="text-blue-300 font-medium">${{ number_format($pago->proyecto->deposito, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-600/30">
                                <span class="text-gray-300">Total Pagado:</span>
                                <span class="text-green-300 font-medium">${{ number_format($pago->proyecto->total_pagado, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-300">Saldo Pendiente:</span>
                                <span class="text-red-300 font-medium">${{ number_format($pago->proyecto->saldo_real, 2) }}</span>
                            </div>
                        </div>
                        
                        <!-- Barra de progreso de pagos -->
                        <div class="mt-4">
                            <div class="flex justify-between text-sm text-gray-300 mb-2">
                                <span>Progreso de Pagos</span>
                                <span>{{ number_format((($pago->proyecto->deposito + $pago->proyecto->total_pagado) / $pago->proyecto->total) * 100, 1) }}%</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-green-600 to-green-400 h-2 rounded-full" 
                                     style="width: {{ (($pago->proyecto->deposito + $pago->proyecto->total_pagado) / $pago->proyecto->total) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Historial de Pagos del Proyecto -->
                    <div class="glass rounded-xl p-6 border border-red-500/20 bg-black/20 backdrop-blur-sm">
                        <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Historial de Pagos
                        </h3>
                        <div class="space-y-3 max-h-64 overflow-y-auto">
                            @forelse($pago->proyecto->pagos as $pagoHistorial)
                                <div class="flex justify-between items-center py-2 px-3 rounded-md
                                    {{ $pagoHistorial->id === $pago->id ? 'bg-red-600/20 border border-red-500/30' : 'bg-gray-700/20' }}">
                                    <div>
                                        <p class="text-white font-medium">${{ number_format($pagoHistorial->monto, 2) }}</p>
                                        <p class="text-xs text-gray-400">{{ $pagoHistorial->fecha_pago->format('d/m/Y') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-300">{{ $pagoHistorial->metodo_nombre }}</p>
                                        @if($pagoHistorial->id === $pago->id)
                                            <span class="text-xs text-red-300 font-medium">Actual</span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-400 text-center py-4">No hay otros pagos registrados</p>
                            @endforelse
                        </div>
                        
                        @if($pago->proyecto->pagos->count() > 1)
                            <div class="mt-4 pt-4 border-t border-gray-600/30">
                                <a href="{{ route('pagos.index', ['proyecto_id' => $pago->proyecto_id]) }}" class="text-blue-400 hover:text-blue-300 text-sm">
                                    Ver todos los pagos de este proyecto →
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Acciones -->
                    <div class="glass rounded-xl p-6 border border-red-500/20 bg-black/20 backdrop-blur-sm">
                        <h3 class="text-lg font-semibold text-white mb-4">Acciones</h3>
                        <div class="space-y-3">
                            <a href="{{ route('pagos.edit', $pago) }}" class="block w-full px-4 py-2 bg-yellow-600/20 text-yellow-300 rounded-md hover:bg-yellow-600/30 transition-colors duration-200 border border-yellow-500/30 text-center">
                                Editar Pago
                            </a>
                            @if($pago->proyecto->saldo_pendiente_actualizado > 0)
                                <a href="{{ route('pagos.create', ['proyecto_id' => $pago->proyecto_id]) }}" class="block w-full px-4 py-2 bg-green-600/20 text-green-300 rounded-md hover:bg-green-600/30 transition-colors duration-200 border border-green-500/30 text-center">
                                    Registrar Otro Pago
                                </a>
                            @endif
                            <form action="{{ route('pagos.destroy', $pago) }}" method="POST" class="w-full" onsubmit="return confirm('¿Estás seguro de eliminar este pago?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-4 py-2 bg-red-600/20 text-red-300 rounded-md hover:bg-red-600/30 transition-colors duration-200 border border-red-500/30">
                                    Eliminar Pago
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
