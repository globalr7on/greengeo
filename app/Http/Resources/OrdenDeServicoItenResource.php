<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProdutoResource;
use App\Http\Resources\TratamentoResource;
use App\Http\Resources\NotaFiscalItenResource;

class OrdenDeServicoItenResource extends JsonResource
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
            'peso' => $this->peso,
            'observacao' => $this->observacao,
            'peso_controle_transportador' => $this->peso_controle_transportador,
            'peso_controle_destinador' => $this->peso_controle_destinador,
            'ordem_servico_id' => $this->ordem_servico_id,
            'produto_id' => $this->produto_id,
            'produto' => new ProdutoResource($this->produto),
            'tratamento_id' => $this->tratamento_id,
            'tratamento' => new TratamentoResource($this->tratamento),
            'quantidade' => $this->quantidade,
            'ativo' => $this->ativo,
        ];
    }
}
