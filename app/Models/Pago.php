<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pago extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'proyecto_id',
        'monto',
        'metodo',
        'descripcion',
        'fecha_pago',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'monto' => 'decimal:2',
        'fecha_pago' => 'date',
        'proyecto_id' => 'integer',
    ];

    /**
     * Los posibles métodos de pago
     */
    const METODOS = [
        'efectivo' => 'Efectivo',
        'transferencia' => 'Transferencia Bancaria',
        'tarjeta_credito' => 'Tarjeta de Crédito',
        'tarjeta_debito' => 'Tarjeta de Débito',
        'paypal' => 'PayPal',
        'mercado_pago' => 'Mercado Pago',
        'otro' => 'Otro',
    ];

    /**
     * Scope para filtrar por método de pago
     */
    public function scopeMetodo($query, $metodo)
    {
        return $query->where('metodo', $metodo);
    }

    /**
     * Scope para filtrar por fecha
     */
    public function scopeFecha($query, $fecha)
    {
        return $query->whereDate('fecha_pago', $fecha);
    }

    /**
     * Scope para filtrar por rango de fechas
     */
    public function scopeEntreFechas($query, $fechaInicio, $fechaFin)
    {
        return $query->whereBetween('fecha_pago', [$fechaInicio, $fechaFin]);
    }

    /**
     * Accessor para obtener el nombre del método de pago
     */
    public function getMetodoNombreAttribute()
    {
        return self::METODOS[$this->metodo] ?? $this->metodo;
    }

    /**
     * Mutator para el monto
     */
    public function setMontoAttribute($value)
    {
        $this->attributes['monto'] = round($value, 2);
    }

    /**
     * Relación con el proyecto
     */
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
