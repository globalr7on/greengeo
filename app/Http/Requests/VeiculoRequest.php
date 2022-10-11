<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class VeiculoRequest extends FormRequest

{
    public function rules()
    {
        return [
            // 'chassis' => 'required|string|max:18',
            'placa' => 'required|string|max:18',
            'capacidade_media_carga' => 'required|numeric',
            'renavam' => 'required|string|max:50',
            'combustivel' => 'required|string|max:40',
            'modelo_id' => 'required',
            'marca_id' => 'required',
            'acondicionamento_id' => 'required',
            'pessoa_juridica_id' => 'required',
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
