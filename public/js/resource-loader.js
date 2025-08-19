// Script para manejar problemas de tracking prevention y carga de recursos
(function() {
    'use strict';
    
    // Función para verificar si un recurso se cargó correctamente
    function checkResourceLoaded(selector, property, expectedValue) {
        try {
            const element = document.querySelector(selector);
            if (!element) return false;
            
            const computedStyle = window.getComputedStyle(element);
            return computedStyle[property] !== expectedValue;
        } catch (e) {
            console.warn('Error checking resource:', e);
            return false;
        }
    }
    
    // Función para cargar CSS de respaldo
    function loadFallbackCSS(href, id) {
        if (document.getElementById(id)) return;
        
        const link = document.createElement('link');
        link.id = id;
        link.rel = 'stylesheet';
        link.href = href;
        link.onerror = function() {
            console.warn('Failed to load fallback CSS:', href);
        };
        document.head.appendChild(link);
    }
    
    // Función para verificar y cargar FontAwesome
    function ensureFontAwesome() {
        // Crear elemento de prueba
        const testIcon = document.createElement('i');
        testIcon.className = 'fas fa-heart';
        testIcon.style.position = 'absolute';
        testIcon.style.left = '-9999px';
        testIcon.style.fontSize = '16px';
        document.body.appendChild(testIcon);
        
        setTimeout(() => {
            const computedStyle = window.getComputedStyle(testIcon, ':before');
            const content = computedStyle.content;
            
            if (content === 'none' || content === '' || content === 'normal') {
                console.log('FontAwesome not loaded, loading fallbacks...');
                
                // Cargar múltiples fallbacks
                const fallbacks = [
                    'https://use.fontawesome.com/releases/v6.4.0/css/all.css',
                    'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'
                ];
                
                fallbacks.forEach((url, index) => {
                    setTimeout(() => {
                        loadFallbackCSS(url, 'fontawesome-fallback-' + index);
                    }, index * 1000);
                });
            } else {
                console.log('FontAwesome loaded successfully');
            }
            
            document.body.removeChild(testIcon);
        }, 500);
    }
    
    // Función para manejar errores de carga de imágenes
    function handleImageErrors() {
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            img.addEventListener('error', function() {
                console.warn('Failed to load image:', this.src);
                // Agregar una clase para styling de error
                this.classList.add('image-error');
                // Opcional: reemplazar con imagen placeholder
                // this.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiM5OTkiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5JbWFnZW48L3RleHQ+PC9zdmc+';
            });
        });
    }
    
    // Función para verificar storage access
    function checkStorageAccess() {
        try {
            localStorage.setItem('test', 'test');
            localStorage.removeItem('test');
            console.log('Local storage access: OK');
        } catch (e) {
            console.warn('Local storage blocked:', e.message);
        }
        
        try {
            sessionStorage.setItem('test', 'test');
            sessionStorage.removeItem('test');
            console.log('Session storage access: OK');
        } catch (e) {
            console.warn('Session storage blocked:', e.message);
        }
    }
    
    // Inicializar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            ensureFontAwesome();
            handleImageErrors();
            checkStorageAccess();
        });
    } else {
        ensureFontAwesome();
        handleImageErrors();
        checkStorageAccess();
    }
    
    // Verificar recursos después de un tiempo
    setTimeout(() => {
        ensureFontAwesome();
    }, 2000);
    
})();
