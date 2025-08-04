<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Imagen extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'imagenes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'proyecto_id',
        'ruta',
        'tipo',
        'nombre_original',
        'descripcion',
        'orden',
        'tamaño_archivo',
        'tipo_mime',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'proyecto_id' => 'integer',
        'orden' => 'integer',
        'tamaño_archivo' => 'integer',
    ];

    /**
     * Los posibles tipos de imagen
     */
    const TIPOS = [
        'referencia' => 'Imagen de Referencia',
        'tattoo' => 'Imagen del Tatuaje',
    ];

    /**
     * Relación con el proyecto
     */
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    /**
     * Scope para filtrar por tipo
     */
    public function scopeTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    /**
     * Scope para imágenes de referencia
     */
    public function scopeReferencias($query)
    {
        return $query->where('tipo', 'referencia');
    }

    /**
     * Scope para imágenes del tatuaje
     */
    public function scopeTattoos($query)
    {
        return $query->where('tipo', 'tattoo');
    }

    /**
     * Scope para ordenar por orden
     */
    public function scopeOrdenado($query)
    {
        return $query->orderBy('orden')->orderBy('created_at');
    }

    /**
     * Accessor para obtener el nombre del tipo
     */
    public function getTipoNombreAttribute()
    {
        return self::TIPOS[$this->tipo] ?? $this->tipo;
    }

    /**
     * Accessor para obtener la URL completa de la imagen
     */
    public function getUrlAttribute()
    {
        return Storage::url($this->ruta);
    }

    /**
     * Accessor para verificar si el archivo existe
     */
    public function getExisteAttribute()
    {
        return Storage::exists($this->ruta);
    }

    /**
     * Accessor para obtener el tamaño del archivo formateado
     */
    public function getTamañoFormateadoAttribute()
    {
        if (!$this->tamaño_archivo) {
            return 'Desconocido';
        }

        $bytes = $this->tamaño_archivo;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Eliminar el archivo físico al eliminar el registro
     */
    protected static function booted()
    {
        static::deleting(function ($imagen) {
            if (Storage::exists($imagen->ruta)) {
                Storage::delete($imagen->ruta);
            }
        });
    }
}
