<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Gestión de Pagos') }}
            </h2>
            <a href="{{ route('pagos.create') }}" class="px-4 py-2 bg-gradient-to-r from-red-600 to-black text-white rounded-lg font-medium hover:from-red-700 hover:to-gray-900 transition-all duration-300 border border-red-500/30">
                Registrar Pago
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

            <!-- Tarjeta Total General -->
            <div class="mb-6 glass rounded-xl p-6 border border-red-500/20 bg-black/20 backdrop-blur-sm">
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-300 mb-2">Total General de Pagos</h3>
                    <p class="text-4xl font-bold text-white">${{ number_format($pagos->sum('monto'), 2) }}</p>
                    <p class="text-sm text-gray-400 mt-1">{{ $pagos->count() }} transacciones</p>
                </div>
            </div>

            <!-- Tarjetas por Método de Pago -->
            @if($pagos->count() > 0)
                <div class="mb-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @php
                        $pagosPorMetodo = $pagos->groupBy('metodo');
                    @endphp
                    
                    @foreach($pagosPorMetodo as $metodo => $pagosMetodo)
                        <div class="glass rounded-lg p-4 border border-red-500/20 bg-black/20 backdrop-blur-sm">
                            <div class="text-center">
                                <h4 class="text-sm font-medium mb-2
                                    @if($metodo === 'efectivo') text-green-300
                                    @elseif($metodo === 'transferencia') text-blue-300
                                    @elseif(str_contains($metodo, 'tarjeta')) text-purple-300
                                    @else text-gray-300
                                    @endif">
                                    {{ \App\Models\Pago::METODOS[$metodo] ?? ucfirst($metodo) }}
                                </h4>
                                <p class="text-2xl font-bold text-white">${{ number_format($pagosMetodo->sum('monto'), 2) }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $pagosMetodo->count() }} pagos</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm overflow-hidden">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-red-500/20">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Proyecto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Cliente</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Monto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Método</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Fecha</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Descripción</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-red-500/20">
                                @forelse($pagos as $pago)
                                    <tr class="hover:bg-black/30 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-medium">
                                            {{ Str::limit($pago->proyecto->descripcion, 30) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{ $pago->proyecto->cliente }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-bold">
                                            ${{ number_format($pago->monto, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                                @if($pago->metodo === 'efectivo') bg-green-600/20 text-green-300
                                                @elseif($pago->metodo === 'transferencia') bg-blue-600/20 text-blue-300
                                                @elseif(str_contains($pago->metodo, 'tarjeta')) bg-purple-600/20 text-purple-300
                                                @else bg-gray-600/20 text-gray-300
                                                @endif">
                                                {{ $pago->metodo_nombre }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{ $pago->fecha_pago->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-300 max-w-xs">
                                            <div class="truncate">{{ $pago->descripcion ?: 'Sin descripción' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="{{ route('pagos.show', $pago) }}" class="inline-flex items-center px-3 py-1 bg-blue-600/20 text-blue-300 rounded-md hover:bg-blue-600/30 transition-colors duration-200 border border-blue-500/30">
                                                Ver
                                            </a>
                                            <a href="{{ route('pagos.edit', $pago) }}" class="inline-flex items-center px-3 py-1 bg-yellow-600/20 text-yellow-300 rounded-md hover:bg-yellow-600/30 transition-colors duration-200 border border-yellow-500/30">
                                                Editar
                                            </a>
                                            <form action="{{ route('pagos.destroy', $pago) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este pago?')">
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
                                        <td colspan="7" class="px-6 py-8 text-center text-gray-400">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                </svg>
                                                <p>No hay pagos registrados</p>
                                                <a href="{{ route('pagos.create') }}" class="mt-2 text-red-400 hover:text-red-300">
                                                    Registrar el primer pago
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($pagos->hasPages())
                        <div class="mt-6">
                            {{ $pagos->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
