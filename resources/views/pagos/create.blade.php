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
            {{-- Debug info - remover en producción --}}
            @if(app()->environment(['local', 'development']))
                <div class="mb-4 p-3 bg-purple-600/20 border border-purple-500/30 rounded-lg backdrop-blur-sm">
                    <p class="text-purple-300 text-sm">
                        <strong>Debug:</strong>
                        Proyecto en URL: {{ request('proyecto_id') ?? 'No' }} |
                        Proyecto seleccionado: {{ $proyectoSeleccionado?->id ?? 'No' }} |
                        Total proyectos: {{ $proyectos->count() }}
                        @if($proyectoSeleccionado)
                            | Cliente: {{ $proyectoSeleccionado->cliente }}
                        @endif
                    </p>
                </div>
            @endif
            
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
                                    <option value="">Seleccionar proyecto ({{ $proyectos->count() }} disponibles)</option>
                                    @foreach($proyectos as $proyecto)
                                        @php
                                            $isSelected = old('proyecto_id', $proyectoSeleccionado?->id ?? request('proyecto_id')) == $proyecto->id;
                                        @endphp
                                        <option value="{{ $proyecto->id }}" 
                                                {{ $isSelected ? 'selected' : '' }}
                                                data-total="{{ $proyecto->total }}"
                                                data-pagado="{{ $proyecto->total_pagado }}"
                                                data-pendiente="{{ $proyecto->saldo_pendiente }}"
                                                data-cliente="{{ $proyecto->cliente }}"
                                                data-descripcion="{{ $proyecto->descripcion }}"
                                                data-usuario="{{ $proyecto->user?->name ?? 'Sin asignar' }}"
                                                data-is-selected="{{ $isSelected ? 'true' : 'false' }}">
                                            {{ $proyecto->cliente }} - {{ $proyecto->descripcion }}
                                            @if($proyecto->user)
                                                ({{ $proyecto->user->name }})
                                            @else
                                                (Sin asignar)
                                            @endif
                                            - Total: ${{ number_format((float)$proyecto->total, 2) }}, Saldo: ${{ number_format((float)$proyecto->saldo_pendiente, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('proyecto_id')" class="mt-2" />
                                
                                @if($proyectos->count() === 0)
                                    <div class="mt-2 p-3 bg-yellow-600/10 border border-yellow-500/30 rounded-md">
                                        <p class="text-yellow-300 text-sm">
                                            <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L3.35 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                            </svg>
                                            No hay proyectos con saldo pendiente disponibles para registrar pagos.
                                        </p>
                                    </div>
                                @endif
                                
                                <!-- Información del proyecto seleccionado -->
                                <div id="proyecto-info" class="mt-3 p-3 bg-blue-600/10 border border-blue-500/30 rounded-md {{ !$proyectoSeleccionado ? 'hidden' : '' }}">
                                    <div id="proyecto-usuario-info" class="mb-3 text-sm {{ !$proyectoSeleccionado || !$proyectoSeleccionado->user ? 'hidden' : '' }}">
                                        <span class="text-gray-300">Usuario asignado:</span>
                                        <span id="proyecto-usuario" class="text-white font-medium">
                                            @if($proyectoSeleccionado && $proyectoSeleccionado->user)
                                                {{ $proyectoSeleccionado->user->name }}
                                            @endif
                                        </span>
                                    </div>
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
            const proyectoUsuarioInfo = document.getElementById('proyecto-usuario-info');
            const proyectoUsuario = document.getElementById('proyecto-usuario');
            const proyectoTotal = document.getElementById('proyecto-total');
            const proyectoPagado = document.getElementById('proyecto-pagado');
            const proyectoPendiente = document.getElementById('proyecto-pendiente');
            const montoInput = document.getElementById('monto');
            const btnSaldoCompleto = document.getElementById('btn-saldo-completo');
            const btnMitadSaldo = document.getElementById('btn-mitad-saldo');

            // Debug inicial
            console.log('🔧 [Debug] Inicializando create de pagos');
            console.log('🔧 [Debug] Proyecto select value:', proyectoSelect.value);
            console.log('🔧 [Debug] Total opciones:', proyectoSelect.options.length);

            function updateProyectoInfo() {
                const selectedOption = proyectoSelect.selectedOptions[0];
                
                console.log('🔧 [Debug] updateProyectoInfo llamado');
                console.log('🔧 [Debug] Selected option:', selectedOption);
                console.log('🔧 [Debug] Selected value:', selectedOption ? selectedOption.value : 'ninguno');
                
                if (selectedOption && selectedOption.value) {
                    const total = parseFloat(selectedOption.dataset.total);
                    const pagado = parseFloat(selectedOption.dataset.pagado);
                    const pendiente = parseFloat(selectedOption.dataset.pendiente);
                    const usuario = selectedOption.dataset.usuario;

                    console.log('🔧 [Debug] Datos del proyecto:', { total, pagado, pendiente, usuario });

                    // Validar que los valores sean números válidos
                    if (!isNaN(total) && !isNaN(pagado) && !isNaN(pendiente)) {
                        // Actualizar información del usuario
                        if (usuario && usuario !== 'Sin asignar') {
                            proyectoUsuario.textContent = usuario;
                            proyectoUsuarioInfo.classList.remove('hidden');
                        } else {
                            proyectoUsuarioInfo.classList.add('hidden');
                        }

                        // Actualizar información financiera
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

                        console.log('✅ [Debug] Proyecto actualizado correctamente');
                    } else {
                        console.error('❌ [Debug] Valores inválidos para el proyecto:', { total, pagado, pendiente });
                        resetProyectoInfo();
                    }
                } else {
                    console.log('ℹ️ [Debug] Sin proyecto seleccionado');
                    resetProyectoInfo();
                }
            }

            function resetProyectoInfo() {
                console.log('🔄 [Debug] Reseteando info del proyecto');
                proyectoInfo.classList.add('hidden');
                proyectoUsuarioInfo.classList.add('hidden');
                btnSaldoCompleto.disabled = true;
                btnMitadSaldo.disabled = true;
                btnSaldoCompleto.classList.add('opacity-50', 'cursor-not-allowed');
                btnMitadSaldo.classList.add('opacity-50', 'cursor-not-allowed');
                btnSaldoCompleto.onclick = null;
                btnMitadSaldo.onclick = null;
            }

            proyectoSelect.addEventListener('change', updateProyectoInfo);
            
            // Inicializar inmediatamente al cargar la página
            console.log('🚀 [Debug] Inicializando primera vez');
            updateProyectoInfo();
            
            // También verificar después de múltiples delays para asegurar que todo se carga
            setTimeout(() => {
                console.log('🕐 [Debug] Re-inicializando después de 100ms');
                updateProyectoInfo();
            }, 100);
            
            setTimeout(() => {
                console.log('🕐 [Debug] Re-inicializando después de 500ms');
                updateProyectoInfo();
                
                // Si hay un proyecto seleccionado, hacer scroll suave hacia la información del proyecto
                if (proyectoSelect.value && !proyectoInfo.classList.contains('hidden')) {
                    proyectoInfo.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    console.log('📍 [Debug] Scroll hacia proyecto info');
                }
            }, 500);
            
            // Validación adicional: forzar selección si hay solo un proyecto con valor específico
            setTimeout(() => {
                console.log('🔍 [Debug] Verificación final después de 1000ms');
                console.log('🔍 [Debug] Valor actual del select:', proyectoSelect.value);
                
                // Si no hay nada seleccionado, buscar opciones marcadas como selected
                if (!proyectoSelect.value && proyectoSelect.options.length > 1) {
                    for (let i = 1; i < proyectoSelect.options.length; i++) { 
                        const option = proyectoSelect.options[i];
                        console.log('🔍 [Debug] Revisando opción:', option.value, 'selected attr:', option.selected, 'data-is-selected:', option.dataset.isSelected);
                        
                        if (option.selected || option.dataset.isSelected === 'true') {
                            console.log('🎯 [Debug] Forzando selección de proyecto:', option.value);
                            proyectoSelect.value = option.value;
                            // Disparar evento change manualmente
                            proyectoSelect.dispatchEvent(new Event('change'));
                            break;
                        }
                    }
                }
                
                // Si aún no hay selección, revisar storage y URL params como último recurso
                if (!proyectoSelect.value) {
                    // Revisar sessionStorage
                    let proyectoIdFromStorage = sessionStorage.getItem('proyecto_seleccionado_pago');
                    if (!proyectoIdFromStorage) {
                        // Revisar localStorage
                        proyectoIdFromStorage = localStorage.getItem('proyecto_seleccionado_pago');
                    }
                    
                    // Revisar URL params
                    const urlParams = new URLSearchParams(window.location.search);
                    const proyectoIdFromUrl = urlParams.get('proyecto_id');
                    
                    const proyectoIdFinal = proyectoIdFromStorage || proyectoIdFromUrl;
                    
                    if (proyectoIdFinal) {
                        console.log('🌐 [Debug] Encontrado proyecto_id en storage/URL:', proyectoIdFinal);
                        proyectoSelect.value = proyectoIdFinal;
                        proyectoSelect.dispatchEvent(new Event('change'));
                        
                        // Limpiar storage después de usar
                        sessionStorage.removeItem('proyecto_seleccionado_pago');
                        localStorage.removeItem('proyecto_seleccionado_pago');
                    }
                }
            }, 1000);
        });
    </script>
</x-app-layout>
