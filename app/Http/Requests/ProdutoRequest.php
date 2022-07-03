<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoRequest extends FormRequest

{
   public function rules()
    {
        return [
            'nome_fabricante' => 'required|string|max:45',
            'peso_bruto' => 'required',
            'peso_liquido' => 'required',
            'dimensoes' =>'required|string|max:30', 
            'altura'  =>'required',
            'largura'  =>'required',
            'profundidade'  =>'required',
            'comprimento'  =>'required',
            'especie' => 'required|string|max:45',
            'marca' => 'required|string|max:45',
            'pessoa_juridica_id'=>'required',
            'material_id' =>'required',
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