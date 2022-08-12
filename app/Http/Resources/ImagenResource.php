<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

const DO_S3_PATH = "https://greenbeat-images.nyc3.digitaloceanspaces.com/";

class ImagenResource extends JsonResource
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
            'url' => $this->url ? DO_S3_PATH.$this->url : null,
            'orden_servico_id' => $this->orden_servico_id,
            'orden_servico' => $this->orden_servico ? $this->orden_servico->id : null,
        ];
    }
}
