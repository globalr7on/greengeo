<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class OrdenDeServicoMotoristasResource extends JsonResource
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
            'ordem_servico_id' => $this->ordem_servico_id,
            'usuario_id' => $this->usuario_id,
            'usuario' => new UserResource($this->usuario),
            'status' => $this->status,
            'observacao' => $this->observacao,
            'data_inicio' => $this->created_at,
            'data_final' => $this->updated_at,
        ];
    }
}
