<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoFormRequest extends FormRequest
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
            'nombre'     => 'required|max:255',
            'apellido'   => 'required|max:255',
            'direccion'  => 'required|max:255',
            'cedula'     => 'required|max:13',
            'telefono'   => 'required|max:20',
            'sexo'       =>'required',
            'edad'       => 'required|max:10',
            'email'      => 'required|email|unique:empleado',
            'imagen'     => 'mimes:jpeg,bmp,png',   
        ];
    }
}
