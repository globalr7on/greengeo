<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgendamentoResource extends JsonResource
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
            'usuario_id' => $this->usuario_id,
            'ordem_servico_id' => $this->ordem_servico_id,  
            'acondicionamento_id' => $this->acondicionamento_id,
            'transportadora_id' => $this->transportadora_id,
            'coleta' => $this->coleta,
        ];
   
    }
}
