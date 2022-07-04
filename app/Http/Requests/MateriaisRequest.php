<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MateriaisRequest extends FormRequest
{
     public function rules()
    {
        return [
            'ean' => 'required|string|max:20',
            'ibama' => 'required',
            'denominacao_ibama' => 'required|string|max:20',
            'peso_bruto' =>'required', 
            'peso_liquido'  =>'required',
            'estado_fisico'  => 'required|string|max:10',
            'percentual_composicao'  =>'required',
            'dimensoes'  => 'required|string|max:30',
            'largura' => 'required',
            'profundidade' => 'required',
            'comprimento'=>'required',
            'nome_no_fabricante' =>'required|string|max:45',
            'especie' =>'required|string|max:45',
            'marca' =>'required|string|max:45',
            'gerador_id' =>'required',
            'tipo_material_id' =>'required',
            'classe_material_id' =>'required',
            'unidade_id' =>'required',
            'nota_fiscal_iten_id' =>'required',
            'ativo'  => 'required',

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
