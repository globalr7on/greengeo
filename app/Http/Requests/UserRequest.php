<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     // return auth()->check();
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|exists:users,email|max:50',
            'password' => 'required|min:6',
            'cpf' => 'required|string|max:50',
            'rg' => 'required|string|max:50',
            'cargo' => 'required|string|max:40',
            'celular' => 'required|string|max:15',
            'fixo' => 'required|string|max:15',
            'whats' => 'required|string|max:15',
            'endereco' => 'required|string|max:50',
            'numero' => 'required|string|max:4',
            'complemento' => 'required|string|max:30',
            'cep' => 'required|string|max:10',
            'bairro' => 'required|string|max:20',
            'cidade' => 'required|string|max:45',
            'estado' => 'required|string|max:2',
            'registro_carteira' => 'required|string|max:30',
            'validade_carteira' => 'required|date|date_format:Y-m-d',
            'tipo_carteira' => 'required|string|max:50',
            'identificador_celular' => 'required|string|max:20',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
