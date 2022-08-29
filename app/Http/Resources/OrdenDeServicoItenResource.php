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
            'numero_de_serie' => $this->numero_de_serie,
            'data_de_fabricacao' => $this->data_de_fabricacao,
            'orden_servico_id' => $this->orden_servico_id,
            'produto_id' => $this->produto_id,
            'produto' => new ProdutoResource($this->produto),
            'tratamento_id' => $this->tratamento_id,
            'tratamento' => new TratamentoResource($this->tratamento),
            'nota_fiscal_item_id' => $this->nota_fiscal_item_id,
            'nota_fiscal_item' => new NotaFiscalItenResource($this->nota_fiscal_item),
        ];
    }
}
