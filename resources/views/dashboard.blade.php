<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard - Ray Tattoo Shop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="glass rounded-2xl shadow-2xl border border-white/10 mb-8 overflow-hidden">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">
                                ¡Bienvenido de vuelta, {{ Auth::user()->name }}! 🎨
                            </h1>
                            <p class="text-gray-300">
                                Tu cuenta en Ray Tattoo Shop está activa y lista para usar.
                            </p>
                        </div>
                        <div class="w-20 h-20 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full flex items-center justify-center shadow-glow">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- User Info -->
                        <div class="bg-white/5 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-white mb-2">Tu Información</h3>
                            <div class="space-y-2 text-gray-300">
                                <p><span class="font-medium">Nombre:</span> {{ Auth::user()->name }}</p>
                                <p><span class="font-medium">Email:</span> {{ Auth::user()->email }}</p>
                                <p><span class="font-medium">Miembro desde:</span> {{ Auth::user()->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="bg-white/5 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-white mb-2">Acciones Rápidas</h3>
                            <div class="space-y-3">
                                <button class="w-full px-4 py-2 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg font-medium hover:from-purple-700 hover:to-blue-700 transition-all duration-300">
                                    Ver Citas
                                </button>
                                <button class="w-full px-4 py-2 bg-white/20 text-white rounded-lg font-medium hover:bg-white/30 transition-all duration-300 border border-white/30">
                                    Mi Perfil
                                </button>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="bg-white/5 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-white mb-2">Estadísticas</h3>
                            <div class="space-y-2 text-gray-300">
                                <p><span class="font-medium">Citas realizadas:</span> 0</p>
                                <p><span class="font-medium">Próxima cita:</span> No hay</p>
                                <p><span class="font-medium">Estado:</span> <span class="text-green-400">Activo</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Appointments -->
                <div class="glass rounded-xl p-6 border border-white/10 hover:bg-white/20 transition-all duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg mb-4 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Citas</h3>
                    <p class="text-gray-300 mb-4">Programa y gestiona tus citas de tatuaje</p>
                    <button class="text-purple-400 hover:text-purple-300 font-medium transition-colors duration-300">
                        Ver más →
                    </button>
                </div>

                <!-- Gallery -->
                <div class="glass rounded-xl p-6 border border-white/10 hover:bg-white/20 transition-all duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-600 rounded-lg mb-4 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Galería</h3>
                    <p class="text-gray-300 mb-4">Explora nuestros trabajos y diseños</p>
                    <button class="text-purple-400 hover:text-purple-300 font-medium transition-colors duration-300">
                        Ver más →
                    </button>
                </div>

                <!-- Contact -->
                <div class="glass rounded-xl p-6 border border-white/10 hover:bg-white/20 transition-all duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg mb-4 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Contacto</h3>
                    <p class="text-gray-300 mb-4">Ponte en contacto con nosotros</p>
                    <button class="text-purple-400 hover:text-purple-300 font-medium transition-colors duration-300">
                        Ver más →
                    </button>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="mt-8 glass rounded-xl p-6 border border-white/10">
                <h3 class="text-xl font-semibold text-white mb-4">Actividad Reciente</h3>
                <div class="text-center py-8">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <p class="text-gray-400">No hay actividad reciente para mostrar</p>
                    <p class="text-gray-500 text-sm mt-2">¡Comienza agendando tu primera cita!</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
