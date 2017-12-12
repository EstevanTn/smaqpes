<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginaPermisoRequest extends FormRequest
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
            'id_padre' => 'nullable|numeric',
            'id_rol' => 'numeric|required|min:1',
            'icono' => 'required|max:50',
            'text' => 'required|max:50',
            'url' => 'nullable|max:200',
        ];
    }
}
