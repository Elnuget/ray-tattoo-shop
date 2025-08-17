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
        Schema::table('proyectos', function (Blueprint $table) {
            // Añadir campo user_id después de id
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            
            // Crear clave foránea que referencia a la tabla users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            
            // Índice para optimizar consultas
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proyectos', function (Blueprint $table) {
            // Primero eliminar la clave foránea
            $table->dropForeign(['user_id']);
            
            // Eliminar el índice
            $table->dropIndex(['user_id']);
            
            // Finalmente eliminar la columna
            $table->dropColumn('user_id');
        });
    }
};
