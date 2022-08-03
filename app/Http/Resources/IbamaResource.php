<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IbamaResource extends JsonResource
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
            'codigo' => $this->codigo,
            'denominacao' => $this->denominacao,
            'classe_sucata_id' => $this->classe_sucata_id,
            'classe_sucata' => $this->classe_sucata ? $this->classe_sucata->descricao : null,
        ];
    }
}
