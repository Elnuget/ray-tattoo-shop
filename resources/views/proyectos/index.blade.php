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

            <div class="glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm overflow-hidden">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-red-500/20">
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Cliente</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Usuario</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Descripción</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Estado</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Total</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Saldo</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Sesiones</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Fecha Inicio</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-red-500/20">
                                @forelse($proyectos as $proyecto)
                                    <tr class="hover:bg-black/30 transition-colors duration-200">
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-white font-medium">
                                            {{ $proyecto->cliente }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{ $proyecto->user ? $proyecto->user->name : 'Sin asignar' }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-300 max-w-xs">
                                            <div class="truncate">{{ $proyecto->descripcion }}</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                                @if($proyecto->estado === 'completado') bg-green-600/20 text-green-300
                                                @elseif($proyecto->estado === 'en_progreso') bg-blue-600/20 text-blue-300
                                                @elseif($proyecto->estado === 'pausado') bg-yellow-600/20 text-yellow-300
                                                @elseif($proyecto->estado === 'cancelado') bg-red-600/20 text-red-300
                                                @else bg-gray-600/20 text-gray-300
                                                @endif">
                                                {{ $proyecto->estado_nombre }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-white">
                                            ${{ number_format($proyecto->total, 2) }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm">
                                            @php
                                                $saldo = $proyecto->saldo_real;
                                            @endphp
                                            <span class="font-medium
                                                @if($saldo > 0) text-red-300
                                                @elseif($saldo == 0) text-green-300
                                                @else text-orange-300
                                                @endif">
                                                ${{ number_format($saldo, 2) }}
                                            </span>
                                            @if($saldo > 0)
                                                <div class="text-xs text-gray-400">Pendiente</div>
                                            @elseif($saldo == 0)
                                                <div class="text-xs text-gray-400">Pagado</div>
                                            @else
                                                <div class="text-xs text-gray-400">Sobrepago</div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{ $proyecto->sesiones }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{ $proyecto->fecha_inicio ? $proyecto->fecha_inicio->format('d/m/Y') : 'No definida' }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="{{ route('proyectos.show', $proyecto) }}" class="inline-flex items-center px-3 py-1 bg-blue-600/20 text-blue-300 rounded-md hover:bg-blue-600/30 transition-colors duration-200 border border-blue-500/30">
                                                Ver
                                            </a>
                                            <a href="{{ route('proyectos.edit', $proyecto) }}" class="inline-flex items-center px-3 py-1 bg-yellow-600/20 text-yellow-300 rounded-md hover:bg-yellow-600/30 transition-colors duration-200 border border-yellow-500/30">
                                                Editar
                                            </a>
                                            @if($proyecto->saldo_real > 0)
                                                <a href="{{ route('pagos.create', ['proyecto_id' => $proyecto->id]) }}" class="inline-flex items-center px-3 py-1 bg-green-600/20 text-green-300 rounded-md hover:bg-green-600/30 transition-colors duration-200 border border-green-500/30" title="Agregar pago para este proyecto">
                                                    Pago
                                                </a>
                                            @endif
                                            <form action="{{ route('proyectos.destroy', $proyecto) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este proyecto?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600/20 text-red-300 rounded-md hover:bg-red-600/30 transition-colors duration-200 border border-red-500/30">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-4 py-8 text-center text-gray-400">
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
</x-app-layout>
