<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MateriaisRequest extends FormRequest
{
     public function rules()
    {
        return [
            'ean' => 'required|string|max:20',
            'ibama_id' => 'required',
            'estado_fisico'  => 'required|string|max:10',
            'gerador_id' =>'required',
            'tipo_material_id' =>'required',
            'unidade_id' =>'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'data' => $validator->errors()
            ])->setStatusCode(400)
        );
    }
}
