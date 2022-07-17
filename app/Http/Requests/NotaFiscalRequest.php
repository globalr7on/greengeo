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
            'numero_total' => 'required',
            'serie' => 'required|string|max:2',
            'folha' => 'required',
            'chave_de_acesso' => 'required|string|max:45',
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
