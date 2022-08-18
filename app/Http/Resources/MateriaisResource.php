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
            'ibama' => $this->ibama ? $this->ibama->codigo : null,
            'estado_fisico' => $this->estado_fisico, 
            'gerador_id' => $this->gerador_id,
            'gerador' => $this->gerador ? $this->gerador->nome_fantasia : null,
            'tipo_material_id' => $this->tipo_material_id,
            'tipo_material'=> $this->tipo_material ? $this->tipo_material->descricao : null,
            'unidade_id' => $this->unidade_id,
            'unidade' => $this->unidade ? $this->unidade->simbolo : null,
            'ativo' =>  $this->ativo,
            'produtos' => $this->produtos ? $this->produtos->pluck('id') : [],
        ];
    }
}
