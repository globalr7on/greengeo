<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AtividadeResource extends JsonResource
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
            'url' => $this->url,
            'nome_arquivo' => $this->nome_arquivo,
            'orden_servico_iten_id' => $this->orden_servico_iten_id,
        ];
    }
}
