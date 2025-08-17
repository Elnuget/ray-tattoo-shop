<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proyecto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'cliente',
        'descripcion',
        'sesiones',
        'fecha_inicio',
        'fecha_fin',
        'fecha_creacion',
        'estado',
        'total',
        'precio_por_sesion',
        'ubicacion_tatuaje',
        'tamaño',
        'estilo',
        'notas',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'fecha_creacion' => 'datetime',
        'total' => 'decimal:2',
        'precio_por_sesion' => 'decimal:2',
        'sesiones' => 'integer',
    ];

    /**
     * Los posibles estados del proyecto
     */
    const ESTADOS = [
        'pendiente' => 'Pendiente',
        'en_progreso' => 'En Progreso',
        'pausado' => 'Pausado',
        'completado' => 'Completado',
        'cancelado' => 'Cancelado',
    ];

    /**
     * Scope para filtrar por estado
     */
    public function scopeEstado($query, $estado)
    {
        return $query->where('estado', $estado);
    }

    /**
     * Scope para proyectos activos (no cancelados ni completados)
     */
    public function scopeActivos($query)
    {
        return $query->whereNotIn('estado', ['cancelado', 'completado']);
    }

    /**
     * Accessor para obtener el nombre del estado
     */
    public function getEstadoNombreAttribute()
    {
        return self::ESTADOS[$this->estado] ?? $this->estado;
    }

    /**
     * Accessor para calcular el saldo pendiente
     */
    public function getSaldoPendienteAttribute()
    {
        return $this->total - $this->total_pagado;
    }

    /**
     * Accessor para verificar si está completado
     */
    public function getEsCompletadoAttribute()
    {
        return $this->estado === 'completado';
    }

    /**
     * Accessor para verificar si está en progreso
     */
    public function getEsEnProgresoAttribute()
    {
        return $this->estado === 'en_progreso';
    }

    /**
     * Mutator para el total
     */
    public function setTotalAttribute($value)
    {
        $this->attributes['total'] = round($value, 2);
    }

    /**
     * Relación con el usuario del proyecto
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con las imágenes del proyecto
     */
    public function imagenes()
    {
        return $this->hasMany(Imagen::class)->ordenado();
    }

    /**
     * Relación con las imágenes de referencia
     */
    public function imagenesReferencia()
    {
        return $this->hasMany(Imagen::class)->referencias()->ordenado();
    }

    /**
     * Relación con las imágenes del tatuaje
     */
    public function imagenesTattoo()
    {
        return $this->hasMany(Imagen::class)->tattoos()->ordenado();
    }

    /**
     * Relación con los pagos del proyecto
     */
    public function pagos()
    {
        return $this->hasMany(Pago::class)->orderBy('fecha_pago', 'desc');
    }

    /**
     * Accessor para calcular el total pagado
     */
    public function getTotalPagadoAttribute()
    {
        return $this->pagos()->sum('monto');
    }

    /**
     * Accessor para calcular el saldo pendiente actualizado
     */
    public function getSaldoPendienteActualizadoAttribute()
    {
        return $this->total - $this->total_pagado;
    }

    /**
     * Accessor para obtener el monto del depósito desde los pagos
     */
    public function getDepositoAttribute()
    {
        return $this->pagos()
            ->where('descripcion', 'Depósito inicial del proyecto')
            ->sum('monto');
    }
}
