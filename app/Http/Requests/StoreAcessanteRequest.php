<?php

namespace App\Http\Requests;

use App\Models\Acessante;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;


class StoreAcessanteRequest extends FormRequest
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

    // public function authorize()
    // {
    //     return auth()->check();
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
    
        return [
            'cpf' => ['required', 'max:14'],
            'rg' => ['required', 'max:15'],
            'nome' => ['required', 'max:50'],
            'e-mail' => ['required', 'max:40'],
            'cargo' => ['required', 'max:40'],
            'celular' => ['required', 'max:15'],
            'fixo' => ['required', 'max:15'],
            'whats' => ['required', 'max:15'],
            'endereco' => ['required', 'max:15'],
            'numero' => ['required', 'max:4'],
            'complemento' => ['required', 'max:30'],
            'cep' => ['required', 'max:10'],
            'bairro' => ['required', 'max:20'],
            'cidade' => ['required', 'max:45'],
            'estado' => ['required', 'max:2'],
            'registro_carteira' => ['required', 'max:30'],
            // 'validade_carteira' => ['required|date|date_format:Y-m-d|before:end_at'],
            'tipo_carteira' => ['required', 'max:1'],
            'identificador_celular' => ['required', 'max:20'],
            'senha_acesso' => ['required', 'max:10']         
        ];
    }
}
