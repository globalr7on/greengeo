<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ProdutoSegregados;
use App\Models\Produto;
// use App\Http\Resources\ProdutoSegregadoResource;
use App\Http\Resources\ProdutoResource;

class NotaFiscalItenResource extends JsonResource
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
            'quantidade' => $this->quantidade,
            'numero_de_serie' => $this->numero_de_serie,
            'data_de_fabricacao' => $this->data_de_fabricacao,
            'usuario_responsavel_cadastro_id' => $this->usuario_responsavel_cadastro_id,
            'usuario_responsavel_cadastro' => $this->usuario_responsavel_cadastro ? $this->usuario_responsavel_cadastro->name : null,
            'produto' => $this->itenable ? new ProdutoResource($this->itenable) : null,
            // 'produto' => $this->itenable
            //     ? $this->itenable_type === Produto::class ? new ProdutoResource($this->itenable) : new ProdutoSegregadoResource($this->itenable)
            //     : null
        ];
    }
}
