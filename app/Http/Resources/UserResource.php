<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'cpf'=>$this->cpf,
            'rg' => $this->rg,
            'cargo' => $this->cargo,
            'celular' => $this->celular,
            'fixo' => $this->fixo,
            'whats' => $this->whats,
            'endereco' => $this->endereco,
            'numero' => $this->numero,
            'complemento' => $this->complemento,
            'cep' => $this->cep,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'registro_carteira' => $this->registro_carteira,
            'tipo_carteira' => $this->tipo_carteira,
            'validade_carteira' => $this->validade_carteira,
            'ativo' => $this->ativo,
            'identificador_celular' => $this->identificador_celular,
            'usuario_responsavel_cadastro_id' => $this->usuario_responsavel_cadastro_id,
            'usuario_responsavel_cadastro' => $this->usuario_responsavel_cadastro ? $this->usuario_responsavel_cadastro->name : null,
            'pessoa_juridica_id' => $this->pessoa_juridica_id,
            'pessoa_juridica' => $this->pessoa_juridica ? $this->pessoa_juridica->nome_fantasia : null,
            'tipo_empresa_id' => $this->pessoa_juridica ? $this->pessoa_juridica->tipo_empresa_id : null,
            //'tipo_empresa' => $this->pessoa_juridica && $this->pessoa_juridica->tipo_empresa ? $this->pessoa_juridica->tipo_empresa->descricao : null,
            'role_web' => $this->roles->filter(function ($roles) { return $roles->guard_name == 'web'; })->pluck('id')->first(),
            'role_name_web' => $this->roles->filter(function ($roles) { return $roles->guard_name == 'web'; })->pluck('name')->first(),
            'role_api' => $this->roles->filter(function ($roles) { return $roles->guard_name == 'api'; })->pluck('id')->first(),
            'role_name_api' => $this->roles->filter(function ($roles) { return $roles->guard_name == 'api'; })->pluck('name')->first(),
        ];
    }
}
