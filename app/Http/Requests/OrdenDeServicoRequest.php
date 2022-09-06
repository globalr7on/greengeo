<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Models\User;

class OrdenDeServicoRequest extends FormRequest
{
    public function rules()
    {
        $currUser = User::find($this->responsavel_id);
        $isRequired = (int) $this->transportador_id == (int) $currUser->pessoa_juridica_id;
        return [
            'responsavel_id' => 'required',
            'gerador_id' => 'required',
            'transportador_id' => 'required',
            'destinador_id' => 'required',
            'acondicionamento_id' => 'required',
            'data_inicio_coleta' => 'required|date|date_format:Y-m-d H:i:s',
            'data_final_coleta' => 'required|date|date_format:Y-m-d H:i:s',
            'produtos' => 'required|array',
            'veiculo_id' => [
                Rule::requiredIf($isRequired)
            ],
            'motorista_id' => [
                Rule::requiredIf($isRequired)
            ],
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
