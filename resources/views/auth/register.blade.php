<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-white mb-2">Crear Cuenta</h2>
        <p class="text-gray-300">Únete a la familia Ray Tattoo Shop</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre Completo')" class="text-red-400 font-semibold" />
            <x-text-input id="name" 
                         class="block mt-1 w-full px-4 py-3 bg-black/80 border border-red-500/30 rounded-lg text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/30 transition-all duration-300 hover:border-red-400" 
                         type="text" 
                         name="name" 
                         :value="old('name')" 
                         required 
                         autofocus 
                         autocomplete="name"
                         placeholder="Tu nombre completo" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" class="text-red-400 font-semibold" />
            <x-text-input id="email" 
                         class="block mt-1 w-full px-4 py-3 bg-black/80 border border-red-500/30 rounded-lg text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/30 transition-all duration-300 hover:border-red-400" 
                         type="email" 
                         name="email" 
                         :value="old('email')" 
                         required 
                         autocomplete="username"
                         placeholder="tu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Contraseña')" class="text-red-400 font-semibold" />
            <x-text-input id="password" 
                         class="block mt-1 w-full px-4 py-3 bg-black/80 border border-red-500/30 rounded-lg text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/30 transition-all duration-300 hover:border-red-400"
                         type="password"
                         name="password"
                         required 
                         autocomplete="new-password"
                         placeholder="Mínimo 8 caracteres" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-red-400 font-semibold" />
            <x-text-input id="password_confirmation" 
                         class="block mt-1 w-full px-4 py-3 bg-black/80 border border-red-500/30 rounded-lg text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/30 transition-all duration-300 hover:border-red-400"
                         type="password"
                         name="password_confirmation" 
                         required 
                         autocomplete="new-password"
                         placeholder="Repite tu contraseña" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="space-y-4">
            <!-- Register Button -->
            <x-primary-button class="w-full justify-center py-3 bg-gradient-to-r from-red-600 to-black hover:from-red-700 hover:to-gray-900 text-white font-bold rounded-lg transition-all duration-300 transform hover:scale-[1.02] shadow-lg border border-red-500/30">
                {{ __('Crear Cuenta') }}
            </x-primary-button>

            <!-- Login Link -->
            <div class="text-center">
                <div class="text-sm text-gray-300">
                    ¿Ya tienes cuenta? 
                    <a href="{{ route('login') }}" 
                       class="text-red-400 hover:text-red-300 font-semibold transition-colors duration-300 underline decoration-red-500/50 hover:decoration-red-400">
                        Inicia sesión aquí
                    </a>
                </div>
            </div>
        </div>
    </form>

    <!-- Divider -->
    <div class="mt-8 pt-8 border-t border-red-500/20">
        <p class="text-center text-xs text-gray-400">
            Al registrarte, aceptas nuestros términos de servicio y política de privacidad.
        </p>
    </div>
</x-guest-layout>
