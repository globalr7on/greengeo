<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PessoaJuridicaRequest extends FormRequest

{
   public function rules()
    {
        return [
            'cnpj' => 'required|string|max:19',
            'nome_fantasia' => 'required|string|max:50',
            'razao_social' => 'required|string|max:50',
            'email' => 'required|string|max:40',
            'contato_1' => 'required|string|max:40',
            'cargo_contato_1' => 'required|string|max:40',
            'contato_2' => 'required|string|max:40',
            'cargo_contato_2' => 'required|string|max:40',
            'celular_contato_1' => 'required|string|max:15',
            'celular_contato_2' => 'required|string|max:15',
            'fixo' => 'required|string|max:15',
            'whatsapp' => 'required|string|max:15',
            'endereco' => 'required|string|max:50',
            'numero' => 'required',
            'complemento' => 'required|string|max:30',
            'cep' => 'required|string|max:10',
            'bairro' => 'required|string|max:20',
            'cidade' => 'required|string|max:45',
            'estado' => 'required|string|max:2',
            'latitude' => 'required|string|max:20',
            'longitude' => 'required|string|max:20',
            'contrato' => 'required|string|max:10',
            'ativo' => 'required',
            'identificador_celular' => 'required|string|max:10',
            'senha_acesso' => 'required|string|max:10',
            'capacidade_media_carga' => 'required|string|max:20',
            'usuario_responsavel_cadastro_id' => 'required',
            'atividade_id' => 'required|string',
            'tipo_empresa_id' => 'required|string'
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
