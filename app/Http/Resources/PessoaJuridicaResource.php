<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PessoaJuridicaResource extends JsonResource
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
            'cnpj' => $this->cnpj,
            'nome_fantasia' => $this->nome_fantasia,
            'razao_social' => $this->razao_social,
            'email' => $this->email,
            'contato_1' =>$this->contato_1,
            'cargo_contato_1' => $this->cargo_contato_1,
            'contato_2' => $this->contato_2,
            'cargo_contato_2' => $this->cargo_contato_2,
            'celular_contato_1' => $this->celular_contato_1,
            'celular_contato_2' => $this->celular_contato_2,
            'fixo' => $this->fixo,
            'whatsapp' => $this->whatsapp,
            'endereco' => $this->endereco,
            'numero' => $this->numero,
            'complemento' => $this->complemento,
            'cep' => $this->cep,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'contrato' => $this->contrato,
            'ativo' => $this->ativo,
            'identificador_celular' => $this->identificador_celular,
            'senha_acesso' => $this->senha_acesso,
            'capacidade_media_carga' => $this->capacidade_media_carga,
            'usuario_responsavel_cadastro_id' => $this->usuario_responsavel_cadastro_id,
            'atividade_id' => $this->atividade_id,
            'tipo_empresa_id' => $this->tipo_empresa_id,
        ];
    }
}
