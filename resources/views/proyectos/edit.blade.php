<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Editar Proyecto') }}: {{ $proyecto->cliente }}
            </h2>
            <a href="{{ route('proyectos.index') }}" class="px-4 py-2 bg-gray-600/20 text-gray-300 rounded-lg font-medium hover:bg-gray-600/30 transition-all duration-300 border border-gray-500/30">
                Volver al Listado
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('proyectos.update', $proyecto) }}" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Información del Cliente -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-semibold text-white mb-4 border-b border-red-500/20 pb-2">Información del Cliente</h3>
                            </div>

                            <!-- Cliente -->
                            <div>
                                <x-input-label for="cliente" :value="__('Cliente')" class="text-white" />
                                <x-text-input id="cliente" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                              type="text" name="cliente" :value="old('cliente', $proyecto->cliente)" required autofocus />
                                <x-input-error :messages="$errors->get('cliente')" class="mt-2" />
                            </div>

                            <!-- Usuario -->
                            <div>
                                <x-input-label for="user_id" :value="__('Usuario Asignado')" class="text-white" />
                                <select id="user_id" name="user_id" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">
                                    <option value="">Seleccionar usuario (opcional)</option>
                                    @foreach($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}" {{ old('user_id', $proyecto->user_id) == $usuario->id ? 'selected' : '' }}>
                                            {{ $usuario->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                            </div>

                            <!-- Descripción -->
                            <div class="md:col-span-2">
                                <x-input-label for="descripcion" :value="__('Descripción del Tatuaje')" class="text-white" />
                                <textarea id="descripcion" name="descripcion" rows="4" 
                                          class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" 
                                          required>{{ old('descripcion', $proyecto->descripcion) }}</textarea>
                                <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                            </div>

                            <!-- Detalles del Proyecto -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-semibold text-white mb-4 border-b border-red-500/20 pb-2">Detalles del Proyecto</h3>
                            </div>

                            <!-- Sesiones -->
                            <div>
                                <x-input-label for="sesiones" :value="__('Número de Sesiones')" class="text-white" />
                                <x-text-input id="sesiones" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                              type="number" name="sesiones" :value="old('sesiones', $proyecto->sesiones)" min="1" required />
                                <x-input-error :messages="$errors->get('sesiones')" class="mt-2" />
                            </div>

                            <!-- Estado -->
                            <div>
                                <x-input-label for="estado" :value="__('Estado')" class="text-white" />
                                <select id="estado" name="estado" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                    <option value="pendiente" {{ old('estado', $proyecto->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="en_progreso" {{ old('estado', $proyecto->estado) == 'en_progreso' ? 'selected' : '' }}>En Progreso</option>
                                    <option value="pausado" {{ old('estado', $proyecto->estado) == 'pausado' ? 'selected' : '' }}>Pausado</option>
                                    <option value="completado" {{ old('estado', $proyecto->estado) == 'completado' ? 'selected' : '' }}>Completado</option>
                                    <option value="cancelado" {{ old('estado', $proyecto->estado) == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                                </select>
                                <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                            </div>

                            <!-- Fecha Inicio -->
                            <div>
                                <x-input-label for="fecha_inicio" :value="__('Fecha de Inicio')" class="text-white" />
                                <x-text-input id="fecha_inicio" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                              type="date" name="fecha_inicio" :value="old('fecha_inicio', $proyecto->fecha_inicio?->format('Y-m-d'))" />
                                <x-input-error :messages="$errors->get('fecha_inicio')" class="mt-2" />
                            </div>

                            <!-- Fecha Fin -->
                            <div>
                                <x-input-label for="fecha_fin" :value="__('Fecha de Finalización')" class="text-white" />
                                <x-text-input id="fecha_fin" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                              type="date" name="fecha_fin" :value="old('fecha_fin', $proyecto->fecha_fin?->format('Y-m-d'))" />
                                <x-input-error :messages="$errors->get('fecha_fin')" class="mt-2" />
                            </div>

                            <!-- Información Financiera -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-semibold text-white mb-4 border-b border-red-500/20 pb-2">Información Financiera</h3>
                            </div>

                            <!-- Total -->
                            <div>
                                <x-input-label for="total" :value="__('Precio Total')" class="text-white" />
                                <x-text-input id="total" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                              type="number" name="total" :value="old('total', $proyecto->total)" step="0.01" min="0" required />
                                <x-input-error :messages="$errors->get('total')" class="mt-2" />
                            </div>

                            <!-- Depósito -->
                            <div>
                                <x-input-label for="deposito" :value="__('Depósito/Anticipo')" class="text-white" />
                                <x-text-input id="deposito" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                              type="number" name="deposito" :value="old('deposito', $proyecto->deposito)" step="0.01" min="0" />
                                <x-input-error :messages="$errors->get('deposito')" class="mt-2" />
                            </div>

                            <!-- Precio por Sesión -->
                            <div>
                                <x-input-label for="precio_por_sesion" :value="__('Precio por Sesión')" class="text-white" />
                                <x-text-input id="precio_por_sesion" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                              type="number" name="precio_por_sesion" :value="old('precio_por_sesion', $proyecto->precio_por_sesion)" step="0.01" min="0" />
                                <x-input-error :messages="$errors->get('precio_por_sesion')" class="mt-2" />
                            </div>

                            <!-- Detalles Técnicos -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-semibold text-white mb-4 border-b border-red-500/20 pb-2">Detalles Técnicos</h3>
                            </div>

                            <!-- Ubicación del Tatuaje -->
                            <div>
                                <x-input-label for="ubicacion_tatuaje" :value="__('Ubicación del Tatuaje')" class="text-white" />
                                <x-text-input id="ubicacion_tatuaje" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                              type="text" name="ubicacion_tatuaje" :value="old('ubicacion_tatuaje', $proyecto->ubicacion_tatuaje)" placeholder="Ej: Brazo derecho, Espalda..." />
                                <x-input-error :messages="$errors->get('ubicacion_tatuaje')" class="mt-2" />
                            </div>

                            <!-- Tamaño -->
                            <div>
                                <x-input-label for="tamaño" :value="__('Tamaño')" class="text-white" />
                                <x-text-input id="tamaño" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                              type="text" name="tamaño" :value="old('tamaño', $proyecto->tamaño)" placeholder="Ej: 10x15 cm, Pequeño, Grande..." />
                                <x-input-error :messages="$errors->get('tamaño')" class="mt-2" />
                            </div>

                            <!-- Estilo -->
                            <div>
                                <x-input-label for="estilo" :value="__('Estilo')" class="text-white" />
                                <x-text-input id="estilo" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                              type="text" name="estilo" :value="old('estilo', $proyecto->estilo)" placeholder="Ej: Realista, Tradicional, Minimalista..." />
                                <x-input-error :messages="$errors->get('estilo')" class="mt-2" />
                            </div>

                            <!-- Notas -->
                            <div class="md:col-span-2">
                                <x-input-label for="notas" :value="__('Notas y Observaciones')" class="text-white" />
                                <textarea id="notas" name="notas" rows="3" 
                                          class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" 
                                          placeholder="Observaciones especiales, alergias, referencias...">{{ old('notas', $proyecto->notas) }}</textarea>
                                <x-input-error :messages="$errors->get('notas')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-red-500/20">
                            <a href="{{ route('proyectos.index') }}" class="px-4 py-2 bg-gray-600/20 text-gray-300 rounded-lg font-medium hover:bg-gray-600/30 transition-all duration-300 border border-gray-500/30">
                                Cancelar
                            </a>
                            <x-primary-button class="bg-gradient-to-r from-red-600 to-black hover:from-red-700 hover:to-gray-900 border border-red-500/30">
                                {{ __('Actualizar Proyecto') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
