<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'ruc' => 'required|max:11',
            'razon_social' => 'required|max:150',
            'nombre_comercial' => 'nullable|max:150',
            'direccion_cliente' => 'required|max:250',
            'tipo_documento' => 'numeric|min:1',
            'numero_documento' => 'required|digits_between:8,20',
            'nombres' => 'required|max:70',
            'apellidos' => 'required|max:100',
            'direccion' => 'required|max:150',
            'email' => 'nullable|email|max:100',
            'fecha_nacimiento' => 'nullable|date',

        ];
    }
}
