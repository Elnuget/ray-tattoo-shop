<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-white mb-2">Crear Cuenta</h2>
        <p class="text-gray-300">Únete a la familia Ray Tattoo Shop</p>
    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
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

        <!-- Foto de Perfil (Opcional) -->
        <div>
            <x-input-label for="foto" :value="__('Foto de Perfil (Opcional)')" class="text-red-400 font-semibold" />
            <input id="foto" 
                   class="block mt-1 w-full px-4 py-3 bg-black/80 border border-red-500/30 rounded-lg text-white file:bg-red-600/20 file:border-0 file:text-white file:px-4 file:py-2 file:rounded-lg file:hover:bg-red-600/30 transition-all duration-300" 
                   type="file" 
                   name="foto" 
                   accept="image/*" />
            <p class="text-gray-400 text-sm mt-1">JPG, PNG, GIF. Máximo 2MB</p>
            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
        </div>

        <!-- Descripción (Opcional) -->
        <div>
            <x-input-label for="descripcion" :value="__('Sobre ti (Opcional)')" class="text-red-400 font-semibold" />
            <textarea id="descripcion" 
                      name="descripcion" 
                      rows="3" 
                      class="block mt-1 w-full px-4 py-3 bg-black/80 border border-red-500/30 rounded-lg text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/30 transition-all duration-300 hover:border-red-400 resize-none"
                      placeholder="Cuéntanos sobre ti, tus gustos en tatuajes, experiencia...">{{ old('descripcion') }}</textarea>
            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
        </div>

        <!-- Redes Sociales (Opcional) -->
        <div>
            <x-input-label :value="__('Redes Sociales (Opcional)')" class="text-red-400 font-semibold mb-3" />
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="redes_instagram" class="block text-sm font-medium text-gray-300 mb-1">Instagram</label>
                    <x-text-input id="redes_instagram" 
                                  class="block w-full px-4 py-2 bg-black/80 border border-red-500/30 rounded-lg text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/30 transition-all duration-300 hover:border-red-400" 
                                  type="text" 
                                  name="redes[instagram]" 
                                  :value="old('redes.instagram')" 
                                  placeholder="@tu_usuario" />
                </div>
                <div>
                    <label for="redes_facebook" class="block text-sm font-medium text-gray-300 mb-1">Facebook</label>
                    <x-text-input id="redes_facebook" 
                                  class="block w-full px-4 py-2 bg-black/80 border border-red-500/30 rounded-lg text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/30 transition-all duration-300 hover:border-red-400" 
                                  type="text" 
                                  name="redes[facebook]" 
                                  :value="old('redes.facebook')" 
                                  placeholder="tu_perfil" />
                </div>
                <div>
                    <label for="redes_twitter" class="block text-sm font-medium text-gray-300 mb-1">Twitter</label>
                    <x-text-input id="redes_twitter" 
                                  class="block w-full px-4 py-2 bg-black/80 border border-red-500/30 rounded-lg text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/30 transition-all duration-300 hover:border-red-400" 
                                  type="text" 
                                  name="redes[twitter]" 
                                  :value="old('redes.twitter')" 
                                  placeholder="@tu_usuario" />
                </div>
                <div>
                    <label for="redes_tiktok" class="block text-sm font-medium text-gray-300 mb-1">TikTok</label>
                    <x-text-input id="redes_tiktok" 
                                  class="block w-full px-4 py-2 bg-black/80 border border-red-500/30 rounded-lg text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/30 transition-all duration-300 hover:border-red-400" 
                                  type="text" 
                                  name="redes[tiktok]" 
                                  :value="old('redes.tiktok')" 
                                  placeholder="@tu_usuario" />
                </div>
            </div>
            <x-input-error :messages="$errors->get('redes')" class="mt-2" />
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
