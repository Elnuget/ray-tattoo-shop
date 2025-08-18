<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\GaleriaController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $artists = User::whereNotNull('descripcion')
        ->where('descripcion', '!=', '')
        ->where('visible', true)
        ->orderBy('created_at', 'desc')
        ->get();
    
    // Obtener imágenes de tatuajes con sus usuarios y proyectos
    $imagenesTattoo = \App\Models\Imagen::with(['proyecto.user'])
        ->where('tipo', 'tattoo')
        ->whereHas('proyecto.user', function($query) {
            $query->where('visible', true);
        })
        ->orderBy('created_at', 'desc')
        ->get();
    
    // Obtener todos los usuarios (visibles y no visibles) para el filtro
    $todosUsuarios = User::whereHas('proyectos.imagenes', function($query) {
        $query->where('tipo', 'tattoo');
    })->orderBy('name')->get();
    
    return view('welcome', compact('artists', 'imagenesTattoo', 'todosUsuarios'));
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    // Obtener los últimos 5 proyectos del usuario
    $ultimosProyectos = $user->proyectos()
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();
    
    // Estadísticas del usuario
    $totalProyectos = $user->proyectos()->count();
    $proyectosActivos = $user->proyectos()->activos()->count();
    $proyectosCompletados = $user->proyectos()->estado('completado')->count();
    
    return view('dashboard', compact(
        'ultimosProyectos', 
        'totalProyectos', 
        'proyectosActivos', 
        'proyectosCompletados'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas para el CRUD de usuarios - Solo administradores
    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class);
    });
    
    // Rutas para el CRUD de proyectos
    Route::resource('proyectos', ProyectoController::class);
    
    // Ruta para cambiar estado de proyectos
    Route::patch('proyectos/{proyecto}/cambiar-estado', [ProyectoController::class, 'cambiarEstado'])->name('proyectos.cambiar-estado');
    
    // Rutas para el CRUD de pagos
    Route::resource('pagos', PagoController::class);
    
    // Ruta específica para crear pago desde proyecto
    Route::get('pagos/create-from-project/{proyecto}', [PagoController::class, 'createFromProject'])->name('pagos.create-from-project');
    
    // Rutas para las imágenes de proyectos (nested routes)
    Route::resource('proyectos.imagenes', ImagenController::class)->except(['show']);
    Route::get('proyectos/{proyecto}/imagenes/{imagen}', [ImagenController::class, 'show'])->name('proyectos.imagenes.show');
    Route::post('proyectos/{proyecto}/imagenes/order', [ImagenController::class, 'updateOrder'])->name('proyectos.imagenes.order');
    Route::post('proyectos/{proyecto}/imagenes/modal', [ImagenController::class, 'storeFromModal'])->name('proyectos.imagenes.modal');
    
    // Rutas para la galería general
    Route::get('galeria', [GaleriaController::class, 'index'])->name('galeria.index');
    Route::get('galeria/{imagen}', [GaleriaController::class, 'show'])->name('galeria.show');
    Route::get('proyectos/{proyecto}/galeria', [GaleriaController::class, 'imagenesProyecto'])->name('proyectos.galeria');
});

require __DIR__.'/auth.php';
