<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
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
            'nome_fabricante' => $this->nome_fabricante,
            'peso_bruto' => $this->peso_bruto,
            'peso_liquido' => $this->peso_liquido,
            'dimensoes' => $this->dimensoes, 
            'altura'  => $this->altura,
            'largura'  => $this->largura,
            'profundidade'  => $this->profundidade,
            'comprimento'  => $this->comprimento,
            'especie' => $this->especie,
            'marca' => $this->marca,
            'pessoa_juridica_id' => $this->pessoa_juridica_id,
            'materiais' => $this->materiais ? $this->materiais->pluck('id') : [],
            'ativo'  => $this->ativo,
        ];
    }
}
