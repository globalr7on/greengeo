<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VeiculoResource extends JsonResource
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
            'chassis' => $this->chassis,
            'placa' => $this->placa,
            'capacidade_media_carga'=>$this->capacidade_media_carga,
            'renavam' => $this->renavam,
            'combustivel' => $this->combustivel,
            'ativo' => $this->ativo,
            'pessoa_juridica' => $this->pessoa_juridica ? $this->pessoa_juridica->razao_social : null,
            'pessoa_juridica_id' => $this->pessoa_juridica_id,
            'modelo' => $this->modelo ? $this->modelo->descricao : null,
            'modelo_id' => $this->modelo_id,
            'marca' => $this->marca ? $this->marca->descricao : null,
            'marca_id' => $this->marca_id,
            'acondicionamento' => $this->acondicionamento ? $this->acondicionamento->descricao : null,
            'acondicionamento_id' => $this->acondicionamento_id,
        ];
    }
}
