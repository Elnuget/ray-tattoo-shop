/**
 * Configuración personalizada de Tailwind CSS v4.0 para ROTO Tattoo Studio
 * 
 * Este archivo contiene configuraciones adicionales y utilidades personalizadas
 * para optimizar el uso de Tailwind CSS en el proyecto.
 */

// Exportar configuraciones personalizadas si se necesitan en el futuro
export const customConfig = {
  // Configuraciones específicas del proyecto
  project: {
    name: 'ROTO Tattoo Studio',
    version: '1.0.0',
    tailwindVersion: '4.0.0'
  },
  
  // Utilidades personalizadas que se pueden agregar
  customUtilities: {
    // Ejemplo: utilidades para efectos de vidrio esmerilado
    glass: {
      'backdrop-blur-md': true,
      'bg-white/10': true,
      'border-white/20': true
    }
  },
  
  // Configuraciones de rendimiento
  performance: {
    purge: true,
    minify: true,
    prefixSelector: false
  }
};
