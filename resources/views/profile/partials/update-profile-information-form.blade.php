<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Información del Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-300">
            {{ __("Actualiza la información de tu cuenta y dirección de correo electrónico.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Foto de Perfil -->
        <div>
            <x-input-label for="foto" :value="__('Foto de Perfil')" class="text-gray-300" />
            
            @if($user->foto)
                <div class="mt-2 mb-3">
                    <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto actual" class="w-20 h-20 rounded-full object-cover border-2 border-red-500/30">
                    <p class="text-xs text-gray-400 mt-1">Foto actual</p>
                </div>
            @endif
            
            <input id="foto" name="foto" type="file" accept="image/*" class="mt-1 block w-full text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:text-sm file:font-medium file:bg-red-600/20 file:text-red-300 hover:file:bg-red-600/30 file:border file:border-red-500/30 bg-black/30 border border-red-500/30 rounded-lg" />
            <p class="text-xs text-gray-400 mt-1">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</p>
            <x-input-error class="mt-2" :messages="$errors->get('foto')" />
        </div>

        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" class="text-gray-300" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-yellow-300">
                        {{ __('Tu dirección de correo electrónico no está verificada.') }}

                        <button form="send-verification" class="underline text-sm text-red-400 hover:text-red-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            {{ __('Haz clic aquí para reenviar el correo de verificación.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-300">
                            {{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Descripción -->
        <div>
            <x-input-label for="descripcion" :value="__('Descripción')" class="text-gray-300" />
            <textarea id="descripcion" name="descripcion" rows="4" class="mt-1 block w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500 rounded-lg" placeholder="Cuéntanos sobre ti, tu experiencia, especialidades...">{{ old('descripcion', $user->descripcion) }}</textarea>
            <p class="text-xs text-gray-400 mt-1">Describe tu experiencia, especialidades o cualquier información que quieras compartir.</p>
            <x-input-error class="mt-2" :messages="$errors->get('descripcion')" />
        </div>

        <!-- Redes Sociales -->
        <div class="space-y-4">
            <h3 class="text-md font-medium text-white">{{ __('Redes Sociales') }}</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Instagram -->
                <div>
                    <x-input-label for="instagram" :value="__('Instagram')" class="text-gray-300" />
                    <div class="mt-1 flex rounded-lg shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-red-500/30 bg-red-600/20 text-red-300 text-sm">
                            <i class="bi bi-instagram"></i>
                        </span>
                        <input type="text" id="instagram" name="redes[instagram]" class="flex-1 block w-full rounded-none rounded-r-lg bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" placeholder="tu_usuario" value="{{ old('redes.instagram', $user->redes['instagram'] ?? '') }}">
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('redes.instagram')" />
                </div>

                <!-- Facebook -->
                <div>
                    <x-input-label for="facebook" :value="__('Facebook')" class="text-gray-300" />
                    <div class="mt-1 flex rounded-lg shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-red-500/30 bg-red-600/20 text-red-300 text-sm">
                            <i class="bi bi-facebook"></i>
                        </span>
                        <input type="text" id="facebook" name="redes[facebook]" class="flex-1 block w-full rounded-none rounded-r-lg bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" placeholder="tu.perfil" value="{{ old('redes.facebook', $user->redes['facebook'] ?? '') }}">
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('redes.facebook')" />
                </div>

                <!-- TikTok -->
                <div>
                    <x-input-label for="tiktok" :value="__('TikTok')" class="text-gray-300" />
                    <div class="mt-1 flex rounded-lg shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-red-500/30 bg-red-600/20 text-red-300 text-sm">
                            <i class="bi bi-tiktok"></i>
                        </span>
                        <input type="text" id="tiktok" name="redes[tiktok]" class="flex-1 block w-full rounded-none rounded-r-lg bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" placeholder="@tu_usuario" value="{{ old('redes.tiktok', $user->redes['tiktok'] ?? '') }}">
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('redes.tiktok')" />
                </div>

                <!-- YouTube -->
                <div>
                    <x-input-label for="youtube" :value="__('YouTube')" class="text-gray-300" />
                    <div class="mt-1 flex rounded-lg shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-red-500/30 bg-red-600/20 text-red-300 text-sm">
                            <i class="bi bi-youtube"></i>
                        </span>
                        <input type="text" id="youtube" name="redes[youtube]" class="flex-1 block w-full rounded-none rounded-r-lg bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" placeholder="tu_canal" value="{{ old('redes.youtube', $user->redes['youtube'] ?? '') }}">
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('redes.youtube')" />
                </div>

                <!-- Twitter/X -->
                <div>
                    <x-input-label for="twitter" :value="__('Twitter/X')" class="text-gray-300" />
                    <div class="mt-1 flex rounded-lg shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-red-500/30 bg-red-600/20 text-red-300 text-sm">
                            <i class="bi bi-twitter-x"></i>
                        </span>
                        <input type="text" id="twitter" name="redes[twitter]" class="flex-1 block w-full rounded-none rounded-r-lg bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" placeholder="@tu_usuario" value="{{ old('redes.twitter', $user->redes['twitter'] ?? '') }}">
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('redes.twitter')" />
                </div>

                <!-- WhatsApp -->
                <div>
                    <x-input-label for="whatsapp" :value="__('WhatsApp')" class="text-gray-300" />
                    <div class="mt-1 flex rounded-lg shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-red-500/30 bg-red-600/20 text-red-300 text-sm">
                            <i class="bi bi-whatsapp"></i>
                        </span>
                        <input type="text" id="whatsapp" name="redes[whatsapp]" class="flex-1 block w-full rounded-none rounded-r-lg bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500" placeholder="+1234567890" value="{{ old('redes.whatsapp', $user->redes['whatsapp'] ?? '') }}">
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Incluye el código de país (ej: +52 para México)</p>
                    <x-input-error class="mt-2" :messages="$errors->get('redes.whatsapp')" />
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
        <div class="flex items-center gap-4">
            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-red-600 to-black text-white rounded-lg font-medium hover:from-red-700 hover:to-gray-900 transition-all duration-300 border border-red-500/30">
                {{ __('Guardar') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-300"
                >{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
