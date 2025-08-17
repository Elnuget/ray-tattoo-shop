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
    
    return view('welcome', compact('artists'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
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
    
    // Rutas para el CRUD de pagos
    Route::resource('pagos', PagoController::class);
    
    // Rutas para las imágenes de proyectos (nested routes)
    Route::resource('proyectos.imagenes', ImagenController::class)->except(['show']);
    Route::get('proyectos/{proyecto}/imagenes/{imagen}', [ImagenController::class, 'show'])->name('proyectos.imagenes.show');
    Route::post('proyectos/{proyecto}/imagenes/order', [ImagenController::class, 'updateOrder'])->name('proyectos.imagenes.order');
    
    // Rutas para la galería general
    Route::get('galeria', [GaleriaController::class, 'index'])->name('galeria.index');
    Route::get('galeria/{imagen}', [GaleriaController::class, 'show'])->name('galeria.show');
});

require __DIR__.'/auth.php';
