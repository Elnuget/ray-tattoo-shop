// Filtrado dinámico de galería por usuario
document.addEventListener('DOMContentLoaded', function() {
    const categoryButtons = document.querySelectorAll('#categories .button');
    const galleryItems = document.querySelectorAll('#photos .item');
    
    // Función para filtrar elementos
    function filterGallery(category) {
        let visibleCount = 0;
        
        galleryItems.forEach(item => {
            const img = item.querySelector('img');
            
            if (category === 'todos' || img.getAttribute('data-category-' + category) === 'true') {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Mostrar mensaje si no hay elementos visibles
        showEmptyMessage(visibleCount === 0 && category !== 'todos');
    }
    
    // Función para mostrar/ocultar mensaje de "sin resultados"
    function showEmptyMessage(show) {
        let emptyMessage = document.getElementById('gallery-empty-message');
        
        if (show && !emptyMessage) {
            emptyMessage = document.createElement('div');
            emptyMessage.id = 'gallery-empty-message';
            emptyMessage.className = 'col-12 text-center py-5';
            emptyMessage.innerHTML = `
                <h3 class="text-muted mb-4">No hay trabajos de este artista en la galería</h3>
                <p class="text-muted">Selecciona otro artista o revisa "Todos" para ver toda la galería.</p>
            `;
            
            const photosContainer = document.querySelector('#photos .row');
            photosContainer.appendChild(emptyMessage);
        } else if (!show && emptyMessage) {
            emptyMessage.remove();
        }
    }
    
    // Event listeners para los botones de categoría
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remover clase active de todos los botones
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            
            // Agregar clase active al botón clickeado
            this.classList.add('active');
            
            // Obtener categoría
            const category = this.getAttribute('data-category');
            
            // Filtrar galería
            filterGallery(category);
        });
    });
    
    // Filtro inicial (mostrar todos)
    filterGallery('todos');
});
