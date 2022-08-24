<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AcondicionamentoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'usuario_id' => 'required|number',
            'ordem_servico_id' => 'required|number',
            'acondicionamento_id' => 'required|number',
            'transportadora_id' => 'required|number',
            'coleta' => 'required'
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
