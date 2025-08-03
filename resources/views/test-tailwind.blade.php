<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tailwind CSS Test - Ray Tattoo Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900 min-h-screen">
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <header class="text-center mb-12">
                <h1 class="text-5xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-pink-400 to-purple-300">
                    ⚡ Tailwind CSS Test
                </h1>
                <p class="text-xl text-gray-300">
                    Probando la configuración de Tailwind CSS v4.0 en Laravel
                </p>
            </header>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                <!-- Card 1 -->
                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300 transform hover:scale-105">
                    <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-purple-600 rounded-lg mb-4 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Velocidad</h3>
                    <p class="text-gray-300">Tailwind CSS v4.0 con nueva arquitectura ultrarrápida</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300 transform hover:scale-105">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-600 rounded-lg mb-4 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Responsive</h3>
                    <p class="text-gray-300">Diseño adaptable para todos los dispositivos</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300 transform hover:scale-105">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg mb-4 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Funcional</h3>
                    <p class="text-gray-300">¡Todo funciona perfectamente!</p>
                </div>
            </div>

            <!-- Components Section -->
            <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-8 border border-white/10 mb-12">
                <h2 class="text-3xl font-bold text-white mb-6 text-center">Componentes de Prueba</h2>
                
                <div class="space-y-6">
                    <!-- Buttons -->
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-3">Botones</h3>
                        <div class="flex flex-wrap gap-4">
                            <button class="px-6 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg font-medium hover:from-purple-700 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                Primario
                            </button>
                            <button class="px-6 py-3 bg-white/20 text-white rounded-lg font-medium hover:bg-white/30 transition-all duration-300 border border-white/30">
                                Secundario
                            </button>
                            <button class="px-6 py-3 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-lg font-medium hover:from-pink-600 hover:to-rose-600 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                Accent
                            </button>
                        </div>
                    </div>

                    <!-- Form Elements -->
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-3">Formularios</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Nombre</label>
                                <input type="text" placeholder="Ingresa tu nombre" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition-all duration-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                                <input type="email" placeholder="tu@email.com" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-300">
                            </div>
                        </div>
                    </div>

                    <!-- Alerts -->
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-3">Alertas</h3>
                        <div class="space-y-4">
                            <div class="p-4 bg-green-500/20 border border-green-500/30 rounded-lg">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-green-300 font-medium">¡Éxito! Tailwind CSS está funcionando correctamente.</span>
                                </div>
                            </div>
                            
                            <div class="p-4 bg-blue-500/20 border border-blue-500/30 rounded-lg">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-blue-300 font-medium">Información: Versión 4.0 con todas las características nuevas.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Ray Tattoo Shop</h3>
                    <p class="text-gray-300">Tu proyecto está listo para crear diseños increíbles</p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Tailwind v4.0</h3>
                    <p class="text-gray-300">La versión más rápida y moderna de Tailwind CSS</p>
                </div>
            </div>

            <!-- Footer -->
            <footer class="text-center">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600/20 to-blue-600/20 backdrop-blur-lg rounded-full border border-white/20">
                    <span class="text-gray-300 mr-2">✨ Configuración completada por</span>
                    <span class="text-white font-semibold">GitHub Copilot</span>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
