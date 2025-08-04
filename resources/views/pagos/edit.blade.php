<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Editar Pago') }} #{{ $pago->id }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('pagos.show', $pago) }}" class="px-4 py-2 bg-blue-600/20 text-blue-300 rounded-lg font-medium hover:bg-blue-600/30 transition-all duration-300 border border-blue-500/30">
                    Ver Detalles
                </a>
                <a href="{{ route('pagos.index') }}" class="px-4 py-2 bg-gray-600/20 text-gray-300 rounded-lg font-medium hover:bg-gray-600/30 transition-all duration-300 border border-gray-500/30">
                    Volver al Listado
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('pagos.update', $pago) }}" class="space-y-8">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Información del Pago -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-semibold text-white mb-4 border-b border-red-500/20 pb-2">Editar Información del Pago</h3>
                            </div>

                            <!-- Proyecto (Solo lectura) -->
                            <div class="md:col-span-2">
                                <x-input-label for="proyecto_display" :value="__('Proyecto')" class="text-white" />
                                <div class="mt-1 p-3 bg-gray-700/20 border border-gray-500/30 rounded-md">
                                    <p class="text-white font-medium">{{ $pago->proyecto->cliente }}</p>
                                    <p class="text-gray-300 text-sm">{{ $pago->proyecto->descripcion }}</p>
                                    <p class="text-gray-400 text-xs mt-1">
                                        Total: ${{ number_format($pago->proyecto->total, 2) }} | 
                                        Pagado: ${{ number_format($pago->proyecto->total_pagado, 2) }} | 
                                        Pendiente: ${{ number_format($pago->proyecto->saldo_pendiente_actualizado, 2) }}
                                    </p>
                                </div>
                                <input type="hidden" name="proyecto_id" value="{{ $pago->proyecto_id }}">
                            </div>

                            <!-- Monto -->
                            <div>
                                <x-input-label for="monto" :value="__('Monto del Pago')" class="text-white" />
                                <x-text-input id="monto" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                              type="number" name="monto" :value="old('monto', $pago->monto)" min="0" step="0.01" required />
                                <x-input-error :messages="$errors->get('monto')" class="mt-2" />
                                <p class="text-xs text-gray-400 mt-1">Monto original: ${{ number_format($pago->monto, 2) }}</p>
                            </div>

                            <!-- Método de Pago -->
                            <div>
                                <x-input-label for="metodo" :value="__('Método de Pago')" class="text-white" />
                                <select id="metodo" name="metodo" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                    <option value="">Seleccionar método</option>
                                    @foreach(\App\Models\Pago::METODOS as $key => $value)
                                        <option value="{{ $key }}" {{ old('metodo', $pago->metodo) == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('metodo')" class="mt-2" />
                            </div>

                            <!-- Fecha del Pago -->
                            <div>
                                <x-input-label for="fecha_pago" :value="__('Fecha del Pago')" class="text-white" />
                                <x-text-input id="fecha_pago" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                              type="date" name="fecha_pago" :value="old('fecha_pago', $pago->fecha_pago->format('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('fecha_pago')" class="mt-2" />
                            </div>

                            <!-- Información del saldo disponible -->
                            <div>
                                <x-input-label :value="__('Información del Proyecto')" class="text-white" />
                                <div class="mt-1 p-3 bg-blue-600/10 border border-blue-500/30 rounded-md">
                                    <div class="text-sm space-y-1">
                                        <div class="flex justify-between">
                                            <span class="text-gray-300">Saldo disponible:</span>
                                            <span class="text-blue-300 font-medium">
                                                ${{ number_format($pago->proyecto->saldo_pendiente_actualizado + $pago->monto, 2) }}
                                            </span>
                                        </div>
                                        <p class="text-gray-400 text-xs">
                                            (Incluye el monto actual de este pago)
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Descripción -->
                            <div class="md:col-span-2">
                                <x-input-label for="descripcion" :value="__('Descripción (Opcional)')" class="text-white" />
                                <textarea id="descripcion" name="descripcion" rows="3" 
                                          class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" 
                                          placeholder="Añadir detalles adicionales sobre el pago...">{{ old('descripcion', $pago->descripcion) }}</textarea>
                                <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                            </div>

                            <!-- Historial de modificaciones -->
                            <div class="md:col-span-2">
                                <div class="bg-gray-700/20 border border-gray-500/30 rounded-md p-4">
                                    <h4 class="text-white font-medium mb-2">Información de Registro</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <span class="text-gray-300">Creado:</span>
                                            <span class="text-white">{{ $pago->created_at->format('d/m/Y H:i') }}</span>
                                        </div>
                                        @if($pago->updated_at != $pago->created_at)
                                            <div>
                                                <span class="text-gray-300">Última modificación:</span>
                                                <span class="text-white">{{ $pago->updated_at->format('d/m/Y H:i') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4 pt-6 border-t border-red-500/20">
                            <a href="{{ route('pagos.show', $pago) }}" class="px-6 py-2 bg-gray-600/20 text-gray-300 rounded-lg font-medium hover:bg-gray-600/30 transition-all duration-300 border border-gray-500/30">
                                Cancelar
                            </a>
                            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-red-600 to-black text-white rounded-lg font-medium hover:from-red-700 hover:to-gray-900 transition-all duration-300 border border-red-500/30">
                                Actualizar Pago
                            </button>
                        </div>
                    </form>

                    <!-- Sección de advertencias -->
                    <div class="mt-8 p-4 bg-yellow-600/10 border border-yellow-500/30 rounded-md">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-yellow-400 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <h4 class="text-yellow-300 font-medium">Importante</h4>
                                <ul class="text-yellow-200 text-sm mt-1 space-y-1">
                                    <li>• Modificar este pago afectará los cálculos financieros del proyecto</li>
                                    <li>• Asegúrate de que el monto sea correcto antes de guardar</li>
                                    <li>• Los cambios se reflejarán inmediatamente en el resumen del proyecto</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const montoInput = document.getElementById('monto');
            const montoOriginal = {{ $pago->monto }};
            const saldoDisponible = {{ $pago->proyecto->saldo_pendiente_actualizado + $pago->monto }};

            montoInput.addEventListener('input', function() {
                const nuevoMonto = parseFloat(this.value) || 0;
                
                if (nuevoMonto > saldoDisponible) {
                    this.setCustomValidity('El monto no puede ser mayor al saldo disponible ($' + saldoDisponible.toFixed(2) + ')');
                } else {
                    this.setCustomValidity('');
                }
            });
        });
    </script>
</x-app-layout>
