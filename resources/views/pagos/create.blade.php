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
            @if(isset($proyectoSeleccionado))
                <div class="mb-4 p-4 bg-blue-600/20 border border-blue-500/30 rounded-lg backdrop-blur-sm">
                    <p class="text-blue-300">
                        <span class="font-medium">Proyecto seleccionado:</span> 
                        {{ $proyectoSeleccionado->cliente }} - {{ $proyectoSeleccionado->descripcion }}
                    </p>
                    <div class="text-sm text-gray-400 mt-2 grid grid-cols-1 md:grid-cols-3 gap-2">
                        <div>
                            <span class="text-gray-500">Total:</span>
                            <span class="text-white">${{ number_format($proyectoSeleccionado->total, 2) }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Pagado:</span>
                            <span class="text-blue-300">${{ number_format($proyectoSeleccionado->total_pagado, 2) }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Saldo:</span>
                            <span class="text-red-300 font-medium">${{ number_format($proyectoSeleccionado->saldo_pendiente, 2) }}</span>
                        </div>
                    </div>
                </div>
            @endif
            
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
                                                {{ old('proyecto_id', $proyectoSeleccionado?->id ?? request('proyecto_id')) == $proyecto->id ? 'selected' : '' }}
                                                data-total="{{ $proyecto->total }}"
                                                data-pagado="{{ $proyecto->total_pagado }}"
                                                data-pendiente="{{ $proyecto->saldo_pendiente }}"
                                                data-cliente="{{ $proyecto->cliente }}"
                                                data-descripcion="{{ $proyecto->descripcion }}">
                                            {{ $proyecto->cliente }} - {{ $proyecto->descripcion }} 
                                            (Total: ${{ number_format((float)$proyecto->total, 2) }}, Pagado: ${{ number_format((float)$proyecto->total_pagado, 2) }}, Saldo: ${{ number_format((float)$proyecto->saldo_pendiente, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('proyecto_id')" class="mt-2" />
                                
                                <!-- Información del proyecto seleccionado -->
                                <div id="proyecto-info" class="mt-3 p-3 bg-blue-600/10 border border-blue-500/30 rounded-md {{ !$proyectoSeleccionado ? 'hidden' : '' }}">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                        <div>
                                            <span class="text-gray-300">Total del proyecto:</span>
                                            <span id="proyecto-total" class="text-white font-medium">
                                                @if($proyectoSeleccionado)
                                                    ${{ number_format((float)$proyectoSeleccionado->total, 2) }}
                                                @endif
                                            </span>
                                        </div>
                                        <div>
                                            <span class="text-gray-300">Total pagado:</span>
                                            <span id="proyecto-pagado" class="text-blue-300 font-medium">
                                                @if($proyectoSeleccionado)
                                                    ${{ number_format((float)$proyectoSeleccionado->total_pagado, 2) }}
                                                @endif
                                            </span>
                                        </div>
                                        <div>
                                            <span class="text-gray-300">Saldo pendiente:</span>
                                            <span id="proyecto-pendiente" class="text-red-300 font-medium">
                                                @if($proyectoSeleccionado)
                                                    ${{ number_format((float)$proyectoSeleccionado->saldo_pendiente, 2) }}
                                                @endif
                                            </span>
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
                                    <button type="button" id="btn-saldo-completo" class="px-3 py-1 bg-green-600/20 text-green-300 rounded-md hover:bg-green-600/30 transition-colors duration-200 border border-green-500/30 text-sm {{ !$proyectoSeleccionado ? 'opacity-50 cursor-not-allowed' : '' }}" {{ !$proyectoSeleccionado ? 'disabled' : '' }}>
                                        Saldo Completo
                                    </button>
                                    <button type="button" id="btn-mitad-saldo" class="px-3 py-1 bg-blue-600/20 text-blue-300 rounded-md hover:bg-blue-600/30 transition-colors duration-200 border border-blue-500/30 text-sm {{ !$proyectoSeleccionado ? 'opacity-50 cursor-not-allowed' : '' }}" {{ !$proyectoSeleccionado ? 'disabled' : '' }}>
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

                    // Validar que los valores sean números válidos
                    if (!isNaN(total) && !isNaN(pagado) && !isNaN(pendiente)) {
                        proyectoTotal.textContent = '$' + total.toLocaleString('es-MX', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                        proyectoPagado.textContent = '$' + pagado.toLocaleString('es-MX', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                        proyectoPendiente.textContent = '$' + pendiente.toLocaleString('es-MX', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                        
                        proyectoInfo.classList.remove('hidden');
                        
                        // Habilitar botones y quitar clases de deshabilitado
                        btnSaldoCompleto.disabled = false;
                        btnMitadSaldo.disabled = false;
                        btnSaldoCompleto.classList.remove('opacity-50', 'cursor-not-allowed');
                        btnMitadSaldo.classList.remove('opacity-50', 'cursor-not-allowed');

                        // Habilitar botones de acción rápida
                        btnSaldoCompleto.onclick = () => {
                            montoInput.value = pendiente.toFixed(2);
                            montoInput.focus();
                        };
                        btnMitadSaldo.onclick = () => {
                            montoInput.value = (pendiente / 2).toFixed(2);
                            montoInput.focus();
                        };
                    } else {
                        console.error('Valores inválidos para el proyecto:', { total, pagado, pendiente });
                        resetProyectoInfo();
                    }
                } else {
                    resetProyectoInfo();
                }
            }

            function resetProyectoInfo() {
                proyectoInfo.classList.add('hidden');
                btnSaldoCompleto.disabled = true;
                btnMitadSaldo.disabled = true;
                btnSaldoCompleto.classList.add('opacity-50', 'cursor-not-allowed');
                btnMitadSaldo.classList.add('opacity-50', 'cursor-not-allowed');
                btnSaldoCompleto.onclick = null;
                btnMitadSaldo.onclick = null;
            }

            proyectoSelect.addEventListener('change', updateProyectoInfo);
            
            // Inicializar inmediatamente al cargar la página
            updateProyectoInfo();
            
            // También verificar después de un pequeño retraso para asegurar que todos los elementos están cargados
            setTimeout(() => {
                updateProyectoInfo();
                
                // Si hay un proyecto seleccionado, hacer scroll suave hacia la información del proyecto
                if (proyectoSelect.value && !proyectoInfo.classList.contains('hidden')) {
                    proyectoInfo.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            }, 200);
        });
    </script>
</x-app-layout>
