<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TratamentoResource extends JsonResource
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
            'descricao' => $this->descricao,
            'ativo' => $this->ativo,
        ];
    }
}
