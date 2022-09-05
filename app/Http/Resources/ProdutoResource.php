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
            'ativo' => $this->ativo,
            'pessoa_juridica_id' => $this->pessoa_juridica_id,
            'pessoa_juridica' => $this->pessoa_juridica ? $this->pessoa_juridica->nome_fantasia : null,
            'codigo' => $this->codigo,
            'descricao' => $this->descricao,
            'altura' => $this->altura,
            'largura' => $this->largura,
            'profundidade' => $this->profundidade,
            'comprimento' => $this->comprimento,
            'especie' => $this->especie,
            'marca' => $this->marca,
            'ean' => $this->ean,
            'unidade_id' => $this->unidade_id,
            'unidade' => $this->unidade ? $this->unidade->simbolo : null,
            // 'materiais' => $this->materiais->map(function ($material) {
            //     $material->material_id = $material->pivot->material_id;
            //     $material->peso_bruto = $material->pivot->peso_bruto;
            //     $material->peso_liquido = $material->pivot->peso_liquido;
            //     $material->percentual_composicao = $material->pivot->percentual_composicao;
            //     $material->ibama;
            //     $material->tipo_material;
            //     $material->unidade;

            //     return $material;
            // })->makeHidden('pivot')
        ];
    }
}
