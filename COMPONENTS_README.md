# Componentes de Rotto Tattoo Studio

Este proyecto ha sido separado en componentes reutilizables para mejorar la organización y mantenibilidad del código.

## Estructura de Componentes

### 1. Layout Principal
- **Archivo**: `resources/views/layouts/app.blade.php`
- **Descripción**: Layout base con todas las dependencias CSS/JS comunes

### 2. Componentes de Página

#### Preloader (`components/preloader.blade.php`)
- Animación de carga con SVG del logo
- Incluye animaciones CSS personalizadas

#### Navbar (`components/navbar.blade.php`)
- Barra de navegación responsiva
- Enlaces a secciones y login

#### Hero (`components/hero.blade.php`)
- Sección principal con carousel
- Botones de llamada a la acción

#### Artists (`components/artists.blade.php`)
- Sección de artistas
- Utiliza el componente `artist-card` para cada artista

#### Services (`components/services.blade.php`)
- Sección de servicios ofrecidos
- Utiliza el componente `service-card` para cada servicio

#### Gallery (`components/gallery.blade.php`)
- Galería de trabajos con filtros
- Enlaces a modales

#### Gallery Modals (`components/gallery-modals.blade.php`)
- Modales para mostrar imágenes en tamaño completo
- Genera modales dinámicamente con Blade

#### FAQ (`components/faq.blade.php`)
- Sección de preguntas frecuentes
- Acordeones con Bootstrap

#### Contact (`components/contact.blade.php`)
- Formulario de contacto
- Mapa integrado
- Información de contacto

#### Footer (`components/footer.blade.php`)
- Pie de página simple

### 3. Componentes Reutilizables

#### Artist Card (`components/artist-card.blade.php`)
- **Parámetros**:
  - `name`: Nombre del artista
  - `image`: Ruta de la imagen
  - `description`: Descripción del artista
  - `instagram`: URL de Instagram
  - `imagePosition`: 'left' o 'right'

#### Service Card (`components/service-card.blade.php`)
- **Parámetros**:
  - `title`: Título del servicio
  - `icon`: Ruta del icono
  - `description`: Descripción del servicio
  - `animation`: Tipo de animación AOS

## Orden de Carga de Recursos

### CSS (en el HEAD - orden importante):
1. **Bootstrap CSS** - Framework base
2. **AOS CSS** - Animaciones on scroll  
3. **Bootstrap Icons** - Iconografía
4. **Google Fonts** - Tipografías
5. **style.css** - Estilos personalizados principales
6. **preloader.css** - Estilos específicos del preloader

### JavaScript (al final del BODY - orden importante):
1. **AOS JavaScript** - Librería de animaciones
2. **Popper.js** - Requerido para Bootstrap
3. **Bootstrap JavaScript** - Framework de interactividad
4. **Scripts personalizados** - Preloader y inicialización

## Archivos de Estilos

### CSS del Preloader (`resources/css/preloader.css` y `public/css/preloader.css`)
- Estilos específicos para la animación de carga
- Keyframes para animaciones SVG
- Estilos de transición
- Z-index alto (9999) para estar sobre todo el contenido
- **Nota**: El archivo se copia a `public/css/` para acceso directo

## Uso de los Componentes

### Versión Original
- **Archivo**: `resources/views/welcome.blade.php`
- Mantiene toda la funcionalidad en un solo archivo

### Versión con Componentes
- **Archivo**: `resources/views/welcome-components.blade.php`
- Utiliza el layout base y todos los componentes separados

## Ejemplo de Uso

```blade
@extends('layouts.app')

@section('content')
    @include('components.navbar')
    @include('components.hero')
    
    @include('components.artist-card', [
        'name' => 'Juan',
        'image' => 'images/juan.jpg',
        'description' => 'Artista especializado en realismo',
        'instagram' => 'https://instagram.com/juan',
        'imagePosition' => 'left'
    ])
@endsection
```

## Beneficios de la Componentización

1. **Reutilización**: Los componentes pueden ser reutilizados en diferentes páginas
2. **Mantenibilidad**: Cambios en un componente se reflejan en todas las páginas que lo usan
3. **Organización**: Código más limpio y organizado
4. **Flexibilidad**: Fácil personalización mediante parámetros
5. **Escalabilidad**: Fácil agregar nuevos artistas o servicios

## Migración

Para migrar a la versión con componentes:
1. Usar `welcome-components.blade.php` en lugar de `welcome.blade.php`
2. Actualizar las rutas si es necesario
3. Compilar los assets CSS actualizados

## Desarrollo Futuro

- Los datos de artistas y servicios pueden ser movidos a la base de datos
- Los componentes pueden ser convertidos a componentes de clase de Laravel
- Se pueden agregar más parámetros de personalización
