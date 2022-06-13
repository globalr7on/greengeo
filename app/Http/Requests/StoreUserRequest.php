<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'cpf' => 'required|unique:users,cpf',
            'celular' => 'required|unique:users,celular',
            'fixo' => 'required|unique:users,fixo',
            'whats' => 'required|unique:users,whats',
            'endereco' => 'required|unique:users,endereco',
            'numero' => 'required|unique:users,numero',
            'complemento' => 'required|unique:users,complemento',
        ];
    }
}