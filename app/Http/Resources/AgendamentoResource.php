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
            'gerador_id' => $this->gerador_id,
            'gerador' => $this->gerador ? $this->gerador->nome_fantasia : null,
            'ordem_servico_id' => $this->ordem_servico_id,
            'ordem_servico' =>  $this->ordem_servico ? $this->ordem_servico->codigo : null,
            'transportadora_id' => $this->transportadora_id,
            'transportadora' => $this->transportador ? $this->transportador->nome_fantasia : null,
            'acondicionamento_id' => $this->acondicionamento_id,
            'acondicionamento'  => $this->acondicionamento ? $this->acondicionamento->descricao : null,

          
            // 'transportadora' =>  $this->transportadora ? $this->transportadora->codigo : null,
            'coleta' => $this->coleta,
        ];
   
    }
}
