<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class NotaFiscalRequest extends FormRequest
{
     public function rules()
    {
        return [
            'numero_total' => 'required|string|max:10',
            'serie' => 'required|string|max:2',
            'folha' => 'required|integer',
            'chave_de_acesso' => 'required|string|max:60',
            'pessoa_juridica_id' => 'required',
            'produtos_acabados' => 'required|array',
            // 'produtos_acabados' => 'required_without_all:produtos_segregados|nullable',
            // 'produtos_segregados' => 'required_without_all:produtos_acabados|nullable',
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
