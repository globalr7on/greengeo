<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OrdenDeServicoResource;

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
            'usuario' => $this->usuario ? $this->usuario->name : null,
            'gerador' => $this->usuario && $this->usuario->pessoa_juridica ? $this->usuario->pessoa_juridica->nome_fantasia : null,
            'ordem_servico_id' => $this->ordem_servico_id,
            'ordem_servico' =>  new OrdenDeServicoResource($this->ordem_servico),
            'transportadora_id' => $this->transportadora_id,
            'transportadora' => $this->transportadora ? $this->transportadora->nome_fantasia : null,
            'acondicionamento_id' => $this->acondicionamento_id,
            'acondicionamento'  => $this->acondicionamento ? $this->acondicionamento->descricao : null,
            'coleta' => $this->coleta,
        ];
    }
}
