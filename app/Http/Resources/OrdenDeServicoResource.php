<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ImagenResource;
use App\Http\Resources\OrdenDeServicoItenResource;
use App\Http\Resources\OrdenDeServicoMotoristasResource;
use Carbon\Carbon;

const TIMEZONE_BRAZIL = 'America/Sao_Paulo';

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
            'codigo' => $this->codigo,
            'data_estagio' => $this->data_estagio,
            'data_emissao' => $this->data_emissao,
            'data_preenchimento' => $this->data_preenchimento,
            'data_integracao' => $this->data_integracao,
            'description' => $this->description,
            'peso_total' => $this->peso_total,
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
            'mtr_link' => $this->mtr_link ? DO_S3_PATH.$this->mtr_link : null,
            'cdf_link' => $this->cdf_link ? DO_S3_PATH.$this->cdf_link : null,
            'data_inicio_coleta' => (new Carbon(new Carbon($this->data_inicio_coleta, 'UTC'), TIMEZONE_BRAZIL))->format('Y-m-d H:i:s'),
            'data_final_coleta' => (new Carbon(new Carbon($this->data_final_coleta, 'UTC'), TIMEZONE_BRAZIL))->format('Y-m-d H:i:s'),
            'acondicionamento_id' => $this->acondicionamento_id,
            'acondicionamento' => $this->acondicionamento ? $this->acondicionamento->descricao : null,
            'responsavel_id' => $this->responsavel_id,
            'responsavel' => $this->responsavel ? $this->responsavel->name : null,
            'itens' => OrdenDeServicoItenResource::collection($this->itens),
            'imagens' => ImagenResource::collection($this->imagens),
            'aprovacao_motorista' => $this->aprovacao_motorista->filter(function ($data) {
                return $data->status === null;
            })->all(),
            'lista_motoristas' => OrdenDeServicoMotoristasResource::collection($this->aprovacao_motorista),
            'estagios_historico' => $this->estagios_historico,
        ];
    }
}
