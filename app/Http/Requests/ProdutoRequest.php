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
            'ean' => 'required',
            'codigo' => 'required|string|max:45',
            'dimensoes' =>'required|string|max:30', 
            'altura'  =>'required',
            'largura'  =>'required',
            'profundidade'  =>'required',
            'comprimento'  =>'required',
            'especie' => 'required|string|max:45',
            'marca' => 'required|string|max:45',
            'pessoa_juridica_id'=>'required',

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
