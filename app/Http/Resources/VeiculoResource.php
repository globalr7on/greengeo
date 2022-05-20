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
        // return parent::toArray($request);
         return [
            'id' => $this->id,
            'chassis' => $this->chassis,
            'placa' => $this->placa,
            'capacidade_media_carga'=>$this->capacidade_media_carga,
            'renavam' => $this->renavam,
            'combustivel' => $this->combustivel,
            'ativo' => $this->ativo,
            'pessoa_juridica' => $this->pessoa_juridica->nome_fantasia,
            'modelo' => $this->modelo->descricao,
            'marca' => $this->marca->descricao,
            'acondicionamento' => $this->acondicionamento->descricao ,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
