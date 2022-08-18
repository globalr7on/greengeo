<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MateriaisResource;

class ProdutoSegregadoResource extends JsonResource
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
            'peso_bruto' => $this->peso_bruto,
            'peso_liquido' => $this->peso_liquido,
            'percentual_composicao' => $this->percentual_composicao,
            'material_id' => $this->material_id,
            'material' => new MateriaisResource($this->material),
        ];
    }
}
