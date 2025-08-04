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
        Schema::create('imagenes', function (Blueprint $table) {
            $table->id();
            
            // Relación con el proyecto
            $table->foreignId('proyecto_id')->constrained('proyectos')->onDelete('cascade');
            
            // Ruta de la imagen
            $table->string('ruta');
            
            // Tipo de imagen: referencia o tattoo
            $table->enum('tipo', ['referencia', 'tattoo'])->default('referencia');
            
            // Nombre original del archivo (opcional)
            $table->string('nombre_original')->nullable();
            
            // Descripción de la imagen (opcional)
            $table->text('descripcion')->nullable();
            
            // Orden para mostrar las imágenes
            $table->integer('orden')->default(0);
            
            // Tamaño del archivo en bytes
            $table->bigInteger('tamaño_archivo')->nullable();
            
            // Tipo MIME del archivo
            $table->string('tipo_mime')->nullable();
            
            $table->timestamps();
            
            // Índices para optimizar consultas
            $table->index(['proyecto_id', 'tipo']);
            $table->index('tipo');
            $table->index('orden');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes');
    }
};
