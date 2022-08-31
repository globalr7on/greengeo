<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ImagenRequest extends FormRequest
{
    public function rules()
    {
        return [
            'imagens' => 'required|array',
            // 'imagens.*' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'imagens.*' => 'required|mimes:jpg,png,jpeg|max:2048',
            'orden_servicio_id' => 'required',
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
