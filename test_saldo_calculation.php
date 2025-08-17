<?php
/**
 * Script de prueba para verificar el cálculo del saldo
 * Este archivo es solo para pruebas y puede ser eliminado después
 */

require_once 'vendor/autoload.php';

use App\Models\Proyecto;
use App\Models\Pago;

// Configurar Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== PRUEBA DE CÁLCULO DE SALDO ===\n\n";

// Obtener algunos proyectos para probar
$proyectos = Proyecto::with('pagos')->take(3)->get();

foreach ($proyectos as $proyecto) {
    echo "Proyecto ID: {$proyecto->id}\n";
    echo "Cliente: {$proyecto->cliente}\n";
    echo "Total del proyecto: $" . number_format($proyecto->total, 2) . "\n";
    
    // Calcular total pagado manualmente
    $totalPagadoManual = $proyecto->pagos->sum('monto');
    echo "Total pagado (manual): $" . number_format($totalPagadoManual, 2) . "\n";
    
    // Usar el accessor del modelo
    echo "Total pagado (accessor): $" . number_format($proyecto->total_pagado, 2) . "\n";
    
    // Calcular saldo manualmente
    $saldoManual = $proyecto->total - $totalPagadoManual;
    echo "Saldo pendiente (manual): $" . number_format($saldoManual, 2) . "\n";
    
    // Usar el accessor del modelo
    echo "Saldo pendiente (accessor): $" . number_format($proyecto->saldo_pendiente, 2) . "\n";
    
    // Mostrar depósito
    echo "Depósito: $" . number_format($proyecto->deposito, 2) . "\n";
    
    echo "Pagos registrados:\n";
    foreach ($proyecto->pagos as $pago) {
        echo "  - $" . number_format($pago->monto, 2) . " ({$pago->metodo}) - {$pago->descripcion}\n";
    }
    
    echo "\n" . str_repeat("-", 50) . "\n\n";
}

echo "=== FIN DE LA PRUEBA ===\n";
