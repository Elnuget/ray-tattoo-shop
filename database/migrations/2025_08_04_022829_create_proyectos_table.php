<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            
            // Información del cliente
            $table->string('cliente');
            
            // Descripción del proyecto
            $table->text('descripcion');
            
            // Control de sesiones
            $table->integer('sesiones')->default(1);
            
            // Fechas importantes
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->timestamp('fecha_creacion')->useCurrent();
            
            // Estado del proyecto
            $table->enum('estado', [
                'pendiente',
                'en_progreso', 
                'pausado',
                'completado',
                'cancelado'
            ])->default('pendiente');
            
            // Información financiera
            $table->decimal('total', 10, 2)->default(0);
            $table->decimal('deposito', 10, 2)->default(0);
            $table->decimal('precio_por_sesion', 10, 2)->nullable();
            
            // Detalles técnicos del tatuaje
            $table->string('ubicacion_tatuaje')->nullable();
            $table->string('tamaño')->nullable();
            $table->string('estilo')->nullable();
            
            // Observaciones especiales
            $table->text('notas')->nullable();
            
            $table->timestamps();
            
            // Índices para optimizar consultas
            $table->index('estado');
            $table->index('fecha_inicio');
            $table->index('fecha_fin');
            $table->index('cliente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
