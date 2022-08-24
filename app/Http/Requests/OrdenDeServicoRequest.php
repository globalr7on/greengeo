<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrdenDeServicoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data_estagio' => 'required|date|date_format:Y-m-d',
            'mtr' => 'required|integer',
            'emissao' => 'required|date|date_format:Y-m-d',
            'preenchimento' => 'required|date|date_format:Y-m-d',
            'integracao' => 'required|date|date_format:Y-m-d',
            'serie' => 'required|string|max:2', 
            'cdf_serial' => 'required|integer',
            'cdf_ano' => 'required|integer',
            'description' => 'required|string',
            'peso_total_os' => 'required',
            'area_total' => 'required',
            'peso_de_controle' => 'required',
            'estagio_id' => 'required',
            'gerador_id' => 'required',
            'transportador_id'  => 'required',
            'destinador_id' => 'required',
            // 'motorista_id' => 'required',
            // 'veiculo_id' => 'required',
            'nota_fiscal_id' => 'required',
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
