<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Detalles del Usuario') }}: {{ $user->name }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('users.edit', $user) }}" class="px-4 py-2 bg-yellow-600/20 text-yellow-300 rounded-lg font-medium hover:bg-yellow-600/30 transition-all duration-300 border border-yellow-500/30">
                    Editar
                </a>
                <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-600/20 text-gray-300 rounded-lg font-medium hover:bg-gray-600/30 transition-all duration-300 border border-gray-500/30">
                    Volver al Listado
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm overflow-hidden">
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Información del Usuario -->
                        <div class="space-y-6">
                            <div class="bg-black/30 backdrop-blur-sm rounded-lg p-6 border border-red-500/20">
                                <h3 class="text-xl font-semibold text-white mb-4 flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Información Personal
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-300">ID</label>
                                        <p class="text-white text-lg">{{ $user->id }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-300">Nombre</label>
                                        <p class="text-white text-lg">{{ $user->name }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-300">Email</label>
                                        <p class="text-white text-lg">{{ $user->email }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-300">Estado de Verificación</label>
                                        <p class="text-lg">
                                            @if($user->email_verified_at)
                                                <span class="text-green-400">✓ Verificado</span>
                                                <span class="text-gray-400 text-sm block">{{ $user->email_verified_at->format('d/m/Y H:i') }}</span>
                                            @else
                                                <span class="text-yellow-400">⚠ No verificado</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Información de Cuenta -->
                        <div class="space-y-6">
                            <div class="bg-black/30 backdrop-blur-sm rounded-lg p-6 border border-red-500/20">
                                <h3 class="text-xl font-semibold text-white mb-4 flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Información de Cuenta
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-300">Fecha de Registro</label>
                                        <p class="text-white text-lg">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                                        <span class="text-gray-400 text-sm">{{ $user->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-300">Última Actualización</label>
                                        <p class="text-white text-lg">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
                                        <span class="text-gray-400 text-sm">{{ $user->updated_at->diffForHumans() }}</span>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-300">Estado de la Cuenta</label>
                                        <p class="text-green-400 text-lg">✓ Activa</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="mt-8 pt-6 border-t border-red-500/20">
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600/20 text-yellow-300 rounded-lg font-medium hover:bg-yellow-600/30 transition-all duration-300 border border-yellow-500/30">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Editar Usuario
                            </a>
                            
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este usuario? Esta acción no se puede deshacer.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600/20 text-red-300 rounded-lg font-medium hover:bg-red-600/30 transition-all duration-300 border border-red-500/30">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Eliminar Usuario
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
