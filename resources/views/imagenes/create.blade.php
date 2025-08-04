<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Subir Imágenes') }} - {{ $proyecto->cliente }}
            </h2>
            <a href="{{ route('proyectos.imagenes.index', $proyecto) }}" class="px-4 py-2 bg-gray-600/20 text-gray-300 rounded-lg font-medium hover:bg-gray-600/30 transition-all duration-300 border border-gray-500/30">
                Volver a Imágenes
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="glass rounded-2xl shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('proyectos.imagenes.store', $proyecto) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Tipo de imagen -->
                        <div>
                            <x-input-label for="tipo" :value="__('Tipo de Imagen')" class="text-white" />
                            <select id="tipo" name="tipo" class="block mt-1 w-full bg-black/30 border-red-500/30 text-white focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                <option value="">Selecciona el tipo</option>
                                <option value="referencia" {{ old('tipo') == 'referencia' ? 'selected' : '' }}>Imagen de Referencia</option>
                                <option value="tattoo" {{ old('tipo') == 'tattoo' ? 'selected' : '' }}>Imagen del Tatuaje</option>
                            </select>
                            <p class="mt-1 text-sm text-gray-400">
                                <strong>Referencia:</strong> Imágenes que el cliente quiere como base para el diseño.<br>
                                <strong>Tatuaje:</strong> Fotos del tatuaje realizado o en proceso.
                            </p>
                            <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                        </div>

                        <!-- Descripción -->
                        <div>
                            <x-input-label for="descripcion" :value="__('Descripción (Opcional)')" class="text-white" />
                            <textarea id="descripcion" name="descripcion" rows="3" 
                                      class="block mt-1 w-full bg-black/30 border-red-500/30 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" 
                                      placeholder="Describe estas imágenes o agrega notas relevantes...">{{ old('descripcion') }}</textarea>
                            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                        </div>

                        <!-- Subida de archivos -->
                        <div>
                            <x-input-label for="imagenes" :value="__('Seleccionar Imágenes')" class="text-white" />
                            <div class="mt-2">
                                <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-red-500/30 border-dashed rounded-lg bg-black/20 hover:bg-black/30 transition-colors duration-200" id="drop-zone">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-300">
                                            <label for="imagenes" class="relative cursor-pointer bg-red-600/20 rounded-md font-medium text-red-300 hover:text-red-200 focus-within:outline-none focus-within:ring-2 focus-within:ring-red-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-900 px-2 py-1">
                                                <span>Subir archivos</span>
                                                <input id="imagenes" name="imagenes[]" type="file" class="sr-only" multiple accept="image/*" required>
                                            </label>
                                            <p class="pl-1">o arrastra y suelta</p>
                                        </div>
                                        <p class="text-xs text-gray-400">PNG, JPG, GIF, WEBP hasta 5MB cada una (máximo 10 imágenes)</p>
                                    </div>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('imagenes')" class="mt-2" />
                            <x-input-error :messages="$errors->get('imagenes.*')" class="mt-2" />
                        </div>

                        <!-- Preview de imágenes seleccionadas -->
                        <div id="preview-container" class="hidden">
                            <x-input-label :value="__('Imágenes Seleccionadas')" class="text-white mb-3" />
                            <div id="preview-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"></div>
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-red-500/20">
                            <a href="{{ route('proyectos.imagenes.index', $proyecto) }}" class="px-4 py-2 bg-gray-600/20 text-gray-300 rounded-lg font-medium hover:bg-gray-600/30 transition-all duration-300 border border-gray-500/30">
                                Cancelar
                            </a>
                            <x-primary-button class="bg-gradient-to-r from-red-600 to-black hover:from-red-700 hover:to-gray-900 border border-red-500/30" id="submit-btn" disabled>
                                {{ __('Subir Imágenes') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const fileInput = document.getElementById('imagenes');
        const dropZone = document.getElementById('drop-zone');
        const previewContainer = document.getElementById('preview-container');
        const previewGrid = document.getElementById('preview-grid');
        const submitBtn = document.getElementById('submit-btn');
        
        let selectedFiles = [];

        // Manejar selección de archivos
        fileInput.addEventListener('change', handleFiles);

        // Drag and drop
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-red-400', 'bg-red-500/10');
        });

        dropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-red-400', 'bg-red-500/10');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-red-400', 'bg-red-500/10');
            
            const files = Array.from(e.dataTransfer.files);
            handleFiles({ target: { files } });
        });

        function handleFiles(event) {
            const files = Array.from(event.target.files);
            
            // Validar número de archivos
            if (files.length > 10) {
                alert('Máximo 10 imágenes permitidas');
                return;
            }

            // Validar tipos de archivo
            const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            const invalidFiles = files.filter(file => !validTypes.includes(file.type));
            
            if (invalidFiles.length > 0) {
                alert('Solo se permiten archivos de imagen (JPEG, PNG, GIF, WEBP)');
                return;
            }

            // Validar tamaño de archivos
            const maxSize = 5 * 1024 * 1024; // 5MB
            const oversizedFiles = files.filter(file => file.size > maxSize);
            
            if (oversizedFiles.length > 0) {
                alert('Algunos archivos exceden el tamaño máximo de 5MB');
                return;
            }

            selectedFiles = files;
            updatePreview();
            updateSubmitButton();
        }

        function updatePreview() {
            previewGrid.innerHTML = '';
            
            if (selectedFiles.length === 0) {
                previewContainer.classList.add('hidden');
                return;
            }

            previewContainer.classList.remove('hidden');

            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'relative group';
                    previewItem.innerHTML = `
                        <div class="aspect-square bg-black/30 rounded-lg overflow-hidden border border-red-500/20">
                            <img src="${e.target.result}" alt="${file.name}" class="w-full h-full object-cover">
                        </div>
                        <button type="button" onclick="removeFile(${index})" 
                                class="absolute top-2 right-2 bg-red-600/80 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-red-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <p class="mt-1 text-xs text-gray-300 truncate">${file.name}</p>
                        <p class="text-xs text-gray-400">${formatFileSize(file.size)}</p>
                    `;
                    previewGrid.appendChild(previewItem);
                };
                reader.readAsDataURL(file);
            });
        }

        function removeFile(index) {
            selectedFiles.splice(index, 1);
            
            // Actualizar el input file
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            fileInput.files = dt.files;
            
            updatePreview();
            updateSubmitButton();
        }

        function updateSubmitButton() {
            submitBtn.disabled = selectedFiles.length === 0;
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
    </script>
</x-app-layout>
