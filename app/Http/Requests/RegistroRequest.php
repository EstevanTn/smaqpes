<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tipo_registro'=> 'numeric|min:1',
            'id_cliente' => 'numeric|min:1',
            'nombre_cliente' => 'required',
            'id_maquinaria' => 'numeric|min:1',
            'nombre_maquinaria' => 'required',
            'lugar' => 'nullable|max:350',
            'lugar_encontrado' => 'nullable',
            'fecha_emision' => 'nullable|date',
            'total_horas' => 'nullable|numeric',
            'horometro' => 'required|numeric',
            'kilometraje' => 'nullable|numeric',
            'id_operador' => 'numeric|min:1',
            'number_operador' => 'required',
            'id_mecanico' => 'numeric|min:1',
            'nombre_mecanico' => 'required',
            'id_responsable' => 'numeric|min:1',
            'nombre_responsable' => 'required',
            'observacion' => 'nullable|max:500',
            'hora_inicio_mantto' => 'nullable',
            'hora_salida_viaje' => 'nullable',
            'hora_termino_mantto' => 'nullable',
            'hora_llegada_viaje' => 'nullable',
        ];
    }
}
