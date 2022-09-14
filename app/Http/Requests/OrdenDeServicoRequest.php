<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\OrdensServicos;

class OrdenDeServicoRequest extends FormRequest
{
    public function rules()
    {
        $currUser = User::find($this->responsavel_id);
        $isRequired = (int) $this->transportador_id == (int) $currUser->pessoa_juridica_id;
        $OrdemServico = OrdensServicos::find($this->id);
        $fieldRequired = $OrdemServico && $OrdemServico->estagio ? $OrdemServico->estagio->descricao == 'Aguardando Coleta' : false;
        return [
            'responsavel_id' => 'required',
            'gerador_id' => 'required',
            'transportador_id' => 'required',
            'destinador_id' => 'required',
            'acondicionamento_id' => 'required',
            'data_inicio_coleta' => 'required|date|date_format:d-m-Y H:i:s',
            'data_final_coleta' => 'required|date|date_format:d-m-Y H:i:s',
            'produtos' => 'required|array',
            'veiculo_id' => [
                Rule::requiredIf($isRequired)
            ],
            'motorista_id' => [
                Rule::requiredIf($isRequired)
            ],
            'data_estagio' => [
                Rule::requiredIf($fieldRequired),
                'date',
                'date_format:d-m-Y'
            ],
            'data_emissao' => [
                Rule::requiredIf($fieldRequired),
                'date',
                'date_format:d-m-Y'
            ],
            'data_preenchimento' => [
                Rule::requiredIf($fieldRequired),
                'date',
                'date_format:d-m-Y'
            ],
            'data_integracao' => [
                Rule::requiredIf($fieldRequired),
                'date',
                'date_format:d-m-Y'
            ],
            'description' => [
                Rule::requiredIf($fieldRequired)
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
