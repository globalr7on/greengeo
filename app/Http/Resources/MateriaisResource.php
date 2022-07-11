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
            'ibama_id' => $this->ibama_id,
            'estado_fisico' => $this->estado_fisico, 
            'gerador_id' => $this->gerador_id,
            'gerador_nome' => $this->gerador ? $this->gerador->nome_fantasia : null,
            'tipo_material_id' => $this->tipo_material_id,
            'tipo_material'=> $this->tipo_material ? $this->tipo_material->descricao : null,
            'unidade_id' => $this->unidade_id,
            'unidade_sim' => $this->unidade ? $this->unidade->simbolo : null,
            'ativo'  =>  $this->ativo,
            'ibama_id' => $this->ibama_id,
            'ibama_code' => $this->ibama ? $this->ibama->code_ibama : null,
            'ibama_denominacao' => $this->ibama ? $this->ibama->denominacao_ibama : null,
            'produtos' => $this->produtos ? $this->produtos->pluck('id') : [],
        ];
    }
}
