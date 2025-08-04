<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Registrar Pago') }}
            </h2>
            <a href="{{ route('pagos.index') }}" class="px-4 py-2 bg-gray-600/20 text-gray-300 rounded-lg font-medium hover:bg-gray-600/30 transition-all duration-300 border border-gray-500/30">
                Volver al Listado
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('pagos.store') }}" class="space-y-8">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Información del Pago -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-semibold text-white mb-4 border-b border-red-500/20 pb-2">Información del Pago</h3>
                            </div>

                            <!-- Proyecto -->
                            <div class="md:col-span-2">
                                <x-input-label for="proyecto_id" :value="__('Proyecto')" class="text-white" />
                                <select id="proyecto_id" name="proyecto_id" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                    <option value="">Seleccionar proyecto</option>
                                    @foreach($proyectos as $proyecto)
                                        <option value="{{ $proyecto->id }}" 
                                                {{ old('proyecto_id', request('proyecto_id')) == $proyecto->id ? 'selected' : '' }}
                                                data-total="{{ $proyecto->total }}"
                                                data-pagado="{{ $proyecto->total_pagado }}"
                                                data-pendiente="{{ $proyecto->saldo_pendiente_actualizado }}">
                                            {{ $proyecto->cliente }} - {{ $proyecto->descripcion }} 
                                            (Total: ${{ number_format($proyecto->total, 2) }}, Pendiente: ${{ number_format($proyecto->saldo_pendiente_actualizado, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('proyecto_id')" class="mt-2" />
                                
                                <!-- Información del proyecto seleccionado -->
                                <div id="proyecto-info" class="mt-3 p-3 bg-blue-600/10 border border-blue-500/30 rounded-md hidden">
                                    <div class="grid grid-cols-3 gap-4 text-sm">
                                        <div>
                                            <span class="text-gray-300">Total del proyecto:</span>
                                            <span id="proyecto-total" class="text-white font-medium"></span>
                                        </div>
                                        <div>
                                            <span class="text-gray-300">Total pagado:</span>
                                            <span id="proyecto-pagado" class="text-green-300 font-medium"></span>
                                        </div>
                                        <div>
                                            <span class="text-gray-300">Saldo pendiente:</span>
                                            <span id="proyecto-pendiente" class="text-red-300 font-medium"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Monto -->
                            <div>
                                <x-input-label for="monto" :value="__('Monto del Pago')" class="text-white" />
                                <x-text-input id="monto" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                              type="number" name="monto" :value="old('monto')" min="0" step="0.01" required />
                                <x-input-error :messages="$errors->get('monto')" class="mt-2" />
                            </div>

                            <!-- Método de Pago -->
                            <div>
                                <x-input-label for="metodo" :value="__('Método de Pago')" class="text-white" />
                                <select id="metodo" name="metodo" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                    <option value="">Seleccionar método</option>
                                    @foreach(\App\Models\Pago::METODOS as $key => $value)
                                        <option value="{{ $key }}" {{ old('metodo') == $key ? 'selected' : '' }}>
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
                                              type="date" name="fecha_pago" :value="old('fecha_pago', date('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('fecha_pago')" class="mt-2" />
                            </div>

                            <!-- Botones de acción rápida para el monto -->
                            <div>
                                <x-input-label :value="__('Acciones Rápidas')" class="text-white" />
                                <div class="mt-1 flex space-x-2">
                                    <button type="button" id="btn-saldo-completo" class="px-3 py-1 bg-green-600/20 text-green-300 rounded-md hover:bg-green-600/30 transition-colors duration-200 border border-green-500/30 text-sm" disabled>
                                        Saldo Completo
                                    </button>
                                    <button type="button" id="btn-mitad-saldo" class="px-3 py-1 bg-blue-600/20 text-blue-300 rounded-md hover:bg-blue-600/30 transition-colors duration-200 border border-blue-500/30 text-sm" disabled>
                                        50% del Saldo
                                    </button>
                                </div>
                            </div>

                            <!-- Descripción -->
                            <div class="md:col-span-2">
                                <x-input-label for="descripcion" :value="__('Descripción (Opcional)')" class="text-white" />
                                <textarea id="descripcion" name="descripcion" rows="3" 
                                          class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" 
                                          placeholder="Añadir detalles adicionales sobre el pago...">{{ old('descripcion') }}</textarea>
                                <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4 pt-6 border-t border-red-500/20">
                            <a href="{{ route('pagos.index') }}" class="px-6 py-2 bg-gray-600/20 text-gray-300 rounded-lg font-medium hover:bg-gray-600/30 transition-all duration-300 border border-gray-500/30">
                                Cancelar
                            </a>
                            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-red-600 to-black text-white rounded-lg font-medium hover:from-red-700 hover:to-gray-900 transition-all duration-300 border border-red-500/30">
                                Registrar Pago
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const proyectoSelect = document.getElementById('proyecto_id');
            const proyectoInfo = document.getElementById('proyecto-info');
            const proyectoTotal = document.getElementById('proyecto-total');
            const proyectoPagado = document.getElementById('proyecto-pagado');
            const proyectoPendiente = document.getElementById('proyecto-pendiente');
            const montoInput = document.getElementById('monto');
            const btnSaldoCompleto = document.getElementById('btn-saldo-completo');
            const btnMitadSaldo = document.getElementById('btn-mitad-saldo');

            function updateProyectoInfo() {
                const selectedOption = proyectoSelect.selectedOptions[0];
                
                if (selectedOption && selectedOption.value) {
                    const total = parseFloat(selectedOption.dataset.total);
                    const pagado = parseFloat(selectedOption.dataset.pagado);
                    const pendiente = parseFloat(selectedOption.dataset.pendiente);

                    proyectoTotal.textContent = '$' + total.toFixed(2);
                    proyectoPagado.textContent = '$' + pagado.toFixed(2);
                    proyectoPendiente.textContent = '$' + pendiente.toFixed(2);
                    
                    proyectoInfo.classList.remove('hidden');
                    btnSaldoCompleto.disabled = false;
                    btnMitadSaldo.disabled = false;

                    // Habilitar botones de acción rápida
                    btnSaldoCompleto.onclick = () => montoInput.value = pendiente.toFixed(2);
                    btnMitadSaldo.onclick = () => montoInput.value = (pendiente / 2).toFixed(2);
                } else {
                    proyectoInfo.classList.add('hidden');
                    btnSaldoCompleto.disabled = true;
                    btnMitadSaldo.disabled = true;
                }
            }

            proyectoSelect.addEventListener('change', updateProyectoInfo);
            
            // Inicializar si hay un proyecto pre-seleccionado
            if (proyectoSelect.value) {
                updateProyectoInfo();
            }
        });
    </script>
</x-app-layout>
