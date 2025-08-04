<?php

namespace App\Http\Requests;

use App\Models\Pago;
use App\Models\Proyecto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PagoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'proyecto_id' => 'required|exists:proyectos,id',
            'monto' => [
                'required',
                'numeric',
                'min:0.01',
                function ($attribute, $value, $fail) {
                    $proyecto = Proyecto::find($this->proyecto_id);
                    if ($proyecto) {
                        $saldoPendiente = $proyecto->saldo_pendiente_actualizado;
                        
                        // Si estamos editando, sumar el monto actual del pago
                        if ($this->route('pago')) {
                            $pagoActual = $this->route('pago');
                            if ($pagoActual->proyecto_id == $this->proyecto_id) {
                                $saldoPendiente += $pagoActual->monto;
                            }
                        }
                        
                        if ($value > $saldoPendiente) {
                            $fail("El monto no puede exceder el saldo pendiente de $" . number_format($saldoPendiente, 2));
                        }
                    }
                },
            ],
            'metodo' => [
                'required',
                'string',
                Rule::in(array_keys(Pago::METODOS))
            ],
            'descripcion' => 'nullable|string|max:500',
            'fecha_pago' => 'required|date',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'proyecto_id' => 'proyecto',
            'monto' => 'monto',
            'metodo' => 'método de pago',
            'descripcion' => 'descripción',
            'fecha_pago' => 'fecha de pago',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'proyecto_id.required' => 'Debe seleccionar un proyecto.',
            'proyecto_id.exists' => 'El proyecto seleccionado no existe.',
            'monto.required' => 'El monto es obligatorio.',
            'monto.numeric' => 'El monto debe ser un número.',
            'monto.min' => 'El monto debe ser mayor a 0.',
            'metodo.required' => 'Debe seleccionar un método de pago.',
            'metodo.in' => 'El método de pago seleccionado no es válido.',
            'descripcion.max' => 'La descripción no puede exceder los 500 caracteres.',
            'fecha_pago.required' => 'La fecha de pago es obligatoria.',
            'fecha_pago.date' => 'La fecha de pago debe ser una fecha válida.',
        ];
    }
}
