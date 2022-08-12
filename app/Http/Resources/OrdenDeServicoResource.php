<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ImagenResource;

class OrdenDeServicoResource extends JsonResource
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
            'data_estagio' => $this->data_estagio,
            'mtr' => $this->mtr,
            'emissao' => $this->emissao,
            'preenchimento' => $this->preenchimento,
            'integracao' => $this->integracao,
            'serie' => $this->serie,
            'cdf_serial' => $this->cdf_serial,
            'cdf_ano' => $this->cdf_ano,
            'description' => $this->description,
            'peso_total_os' => $this->peso_total_os,
            'area_total' => $this->area_total,
            'peso_de_controle' => $this->peso_de_controle,
            'estagio_id' => $this->estagio_id,
            'estagio' => $this->estagio ? $this->estagio->descricao : null,
            'gerador_id' => $this->gerador_id,
            'gerador' => $this->gerador ? $this->gerador->razao_social : null,
            'gerador_coord' => $this->gerador ? [
                'lat' => $this->gerador->latitude,
                'lng' => $this->gerador->longitude,
            ] : [],
            'transportador_id' => $this->transportador_id,
            'transportador' => $this->transportador ? $this->transportador->razao_social : null,
            'destinador_id' => $this->destinador_id,
            'destinador' => $this->destinador ? $this->destinador->razao_social : null,
            'destinador_coord' => $this->destinador ? [
                'lat' => $this->destinador->latitude,
                'lng' => $this->destinador->longitude,
            ] : [],
            'motorista_id' => $this->motorista_id,
            'motorista' => $this->motorista ? $this->motorista->name : null,
            'veiculo_id' => $this->veiculo_id,
            'veiculo' => $this->veiculo ? $this->veiculo->placa : null,
            'nota_fiscal_id' => $this->nota_fiscal_id,
            'nota_fiscal' => $this->nota_fiscal ? $this->nota_fiscal->serie : null,
            'imagens' => ImagenResource::collection($this->imagens),
        ];
    }
}
