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
            'numero_serie' => 'required',
            'ean' => 'required',
            'descricao' => 'required',
            'codigo' => 'required|string|max:45',
            'altura' =>'required',
            'largura' =>'required',
            'profundidade' =>'required',
            'comprimento' =>'required',
            'especie' => 'required|string|max:45',
            'marca' => 'required|string|max:45',
            'data_fabricacao' => 'required',
            'pessoa_juridica_id' => 'required',
            //'materiais' => 'required|array',
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
