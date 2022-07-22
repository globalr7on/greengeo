<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\NotaFiscalItenResource;

class NotaFiscalResource extends JsonResource
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
            'numero_total' => $this->numero_total,
            'serie' => $this->serie,
            'folha' => $this->folha,
            'chave_de_acesso' => $this->chave_de_acesso,
            'pessoa_juridica_id' => $this->pessoa_juridica_id,
            'pessoa_juridica' => $this->pessoa_juridica ? $this->pessoa_juridica->razao_social : null,
            'itens' => NotaFiscalItenResource::collection($this->nota_fiscal_itens),
        ];
    }
}
