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
            'data_estagio' => 'required|string|max:30',
            'mtr' => 'required|string|max:50',
            'emissao' => 'required|string|max:50',
            'preenchimento' => 'required|string|max:40',
            'integracao' => 'required|string|max:15',
            'serie' => 'required|string|max:40', 
            'cdf_serial' => 'required|string|max:15',
            'cdf_ano' => 'required|string|max:15',
            'description' => 'required|string|max:40',
            'peso_total_os' => 'required',
            'area_total' => 'required',
            'peso_de_controle' => 'required',
            'estagio_id' => 'required',
            'gerador_id' => 'required',
            'transportador_id'  => 'required',
            'destinador_id' => 'required',
            'motorista_id' => 'required',
            'veiculo_id' => 'required',
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
