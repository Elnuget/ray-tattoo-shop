<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Crear Usuario') }}
            </h2>
            <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-600/20 text-gray-300 rounded-lg font-medium hover:bg-gray-600/30 transition-all duration-300 border border-gray-500/30">
                Volver al Listado
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Nombre -->
                        <div>
                            <x-input-label for="name" :value="__('Nombre')" class="text-white" />
                            <x-text-input id="name" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                          type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-white" />
                            <x-text-input id="email" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                          type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Foto de Perfil -->
                        <div>
                            <x-input-label for="foto" :value="__('Foto de Perfil')" class="text-white" />
                            <input id="foto" class="block mt-1 w-full bg-black/30 border border-red-500/30 text-white file:bg-red-600/20 file:border-0 file:text-white file:px-4 file:py-2 file:rounded-lg file:hover:bg-red-600/30 transition-all duration-300" 
                                   type="file" name="foto" accept="image/*" />
                            <p class="text-gray-400 text-sm mt-1">Formatos aceptados: JPG, PNG, GIF. Máximo 2MB</p>
                            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                        </div>

                        <!-- Descripción -->
                        <div>
                            <x-input-label for="descripcion" :value="__('Descripción')" class="text-white" />
                            <textarea id="descripcion" name="descripcion" rows="4" 
                                      class="block mt-1 w-full bg-black/30 border border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500 rounded-md resize-none"
                                      placeholder="Cuéntanos sobre ti, tus especialidades, experiencia...">{{ old('descripcion') }}</textarea>
                            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                        </div>

                        <!-- Redes Sociales -->
                        <div>
                            <x-input-label :value="__('Redes Sociales')" class="text-white mb-3" />
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="redes_instagram" class="block text-sm font-medium text-gray-300">Instagram</label>
                                    <x-text-input id="redes_instagram" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                                  type="text" name="redes[instagram]" :value="old('redes.instagram')" placeholder="@tu_usuario" />
                                </div>
                                <div>
                                    <label for="redes_facebook" class="block text-sm font-medium text-gray-300">Facebook</label>
                                    <x-text-input id="redes_facebook" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                                  type="text" name="redes[facebook]" :value="old('redes.facebook')" placeholder="facebook.com/tu_perfil" />
                                </div>
                                <div>
                                    <label for="redes_twitter" class="block text-sm font-medium text-gray-300">Twitter</label>
                                    <x-text-input id="redes_twitter" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                                  type="text" name="redes[twitter]" :value="old('redes.twitter')" placeholder="@tu_usuario" />
                                </div>
                                <div>
                                    <label for="redes_tiktok" class="block text-sm font-medium text-gray-300">TikTok</label>
                                    <x-text-input id="redes_tiktok" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" 
                                                  type="text" name="redes[tiktok]" :value="old('redes.tiktok')" placeholder="@tu_usuario" />
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('redes')" class="mt-2" />
                        </div>

                        <!-- Es Admin -->
                        <div>
                            <div class="flex items-center">
                                <input type="hidden" name="es_admin" value="0">
                                <input id="es_admin" type="checkbox" name="es_admin" value="1" 
                                       {{ old('es_admin') ? 'checked' : '' }}
                                       class="w-4 h-4 text-red-600 bg-black/30 border-red-500/30 rounded focus:ring-red-500 focus:ring-2">
                                <label for="es_admin" class="ml-2 text-sm font-medium text-white">
                                    Rol de Administrador
                                </label>
                            </div>
                            <p class="text-gray-400 text-sm mt-1">Otorga permisos administrativos a este usuario</p>
                            <x-input-error :messages="$errors->get('es_admin')" class="mt-2" />
                        </div>

                        <!-- Visible -->
                        <div>
                            <div class="flex items-center">
                                <input type="hidden" name="visible" value="0">
                                <input id="visible" type="checkbox" name="visible" value="1" 
                                       {{ old('visible', true) ? 'checked' : '' }}
                                       class="w-4 h-4 text-red-600 bg-black/30 border-red-500/30 rounded focus:ring-red-500 focus:ring-2">
                                <label for="visible" class="ml-2 text-sm font-medium text-white">
                                    Visible en la página principal
                                </label>
                            </div>
                            <p class="text-gray-400 text-sm mt-1">Si está marcado, este artista aparecerá en la sección "Nuestros Artistas"</p>
                            <x-input-error :messages="$errors->get('visible')" class="mt-2" />
                        </div>

                        <!-- Contraseña -->
                        <div>
                            <x-input-label for="password" :value="__('Contraseña')" class="text-white" />
                            <x-text-input id="password" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500"
                                          type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-white" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500"
                                          type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-600/20 text-gray-300 rounded-lg font-medium hover:bg-gray-600/30 transition-all duration-300 border border-gray-500/30">
                                Cancelar
                            </a>
                            <x-primary-button class="bg-gradient-to-r from-red-600 to-black hover:from-red-700 hover:to-gray-900 border border-red-500/30">
                                {{ __('Crear Usuario') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
