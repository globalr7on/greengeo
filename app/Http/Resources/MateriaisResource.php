<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MateriaisResource extends JsonResource
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
            'ean' => $this->ean,
            'ibama' => $this->ibama,
            'denominacao_ibama' => $this->denominacao_ibama, 
            'peso_bruto' => $this->peso_bruto,
            'peso_liquido' => $this->peso_liquido,
            'estado_fisico' => $this->estado_fisico, 
            'percentual_composicao'  => $this->percentual_composicao,
            'dimensoes'  => $this->dimensoes,
            'largura' => $this->largura,
            'profundidade' => $this->profundidade,
            'comprimento'=> $this->comprimento,
            'nome_no_fabricante' => $this->nome_no_fabricante,
            'especie' => $this->especie,
            'marca' => $this->marca,
            'gerador_id' => $this->gerador_id,
            'tipo_material_id' => $this->tipo_material_id,
            'classe_material_id' => $this->classe_material_id,
            'unidade_id' => $this->unidade_id,
            'nota_fiscal_iten_id' => $this->nota_fiscal_iten_id,
            'ativo'  =>  $this->ativo,
            'produtos' => $this->produtos ? $this->produtos->pluck('id') : [],
         

        ];
    }
}
