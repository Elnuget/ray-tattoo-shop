<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-white mb-2">Iniciar Sesión</h2>
        <p class="text-gray-300">Accede a tu cuenta en Ray Tattoo Shop</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" class="text-red-400 font-semibold" />
            <x-text-input id="email" 
                         class="block mt-1 w-full px-4 py-3 bg-black/80 border border-red-500/30 rounded-lg text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/30 transition-all duration-300 hover:border-red-400" 
                         type="email" 
                         name="email" 
                         :value="old('email')" 
                         required 
                         autofocus 
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
                         autocomplete="current-password"
                         placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" 
                       type="checkbox" 
                       class="rounded border-red-500/30 bg-black/80 text-red-500 shadow-sm focus:ring-red-500 focus:ring-offset-0" 
                       name="remember">
                <span class="ms-3 text-sm text-gray-300">{{ __('Recordarme') }}</span>
            </label>
        </div>

        <div class="space-y-4">
            <!-- Login Button -->
            <x-primary-button class="w-full justify-center py-3 bg-gradient-to-r from-red-600 to-black hover:from-red-700 hover:to-gray-900 text-white font-bold rounded-lg transition-all duration-300 transform hover:scale-[1.02] shadow-lg border border-red-500/30">
                {{ __('Iniciar Sesión') }}
            </x-primary-button>

            <!-- Links -->
            <div class="flex flex-col space-y-3 text-center">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-300 hover:text-red-400 transition-colors duration-300 underline decoration-red-500/50 hover:decoration-red-400" 
                       href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif

                @if (Route::has('register'))
                    <div class="text-sm text-gray-300">
                        ¿No tienes cuenta? 
                        <a href="{{ route('register') }}" 
                           class="text-red-400 hover:text-red-300 font-semibold transition-colors duration-300 underline decoration-red-500/50 hover:decoration-red-400">
                            Regístrate aquí
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </form>

    <!-- Divider -->
    <div class="mt-8 pt-8 border-t border-red-500/20">
        <p class="text-center text-xs text-gray-400">
            Al iniciar sesión, aceptas nuestros términos de servicio y política de privacidad.
        </p>
    </div>
</x-guest-layout>
