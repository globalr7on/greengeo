<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RastreamentoRequest;
use App\Http\Resources\RastreamentoResource;
use App\Models\Rastreamento;
use App\Models\OrdensServicos;

class RastreamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rastreamento = Rastreamento::all();

        return response([
            'data' => RastreamentoResource::collection($rastreamento),
            'status' => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RastreamentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RastreamentoRequest $request)
    {
        $ordemServico = OrdensServicos::find($request->get('orden_servico_id'));
        if (!$ordemServico) {
            return response([
                'data' => 'Ordem de serviço não encontrada',
                'status' => false
            ], 400);
        }
        $currentEstagio = strtolower($ordemServico->estagio ? $ordemServico->estagio->descricao : "");
        if (!in_array($currentEstagio, ['emitida', 'transporte'])) {
            return response([
                'data' => 'Status da ordem de serviço não adequado para rastreamento',
                'status' => false
            ], 400);
        }
        $rastreamento = Rastreamento::create($request->all());
        return response([
            'status' => true
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $ordemServico = OrdensServicos::find($id);
        $rastreamentos = $request->has('ultimo')
            ? $ordemServico->rastreamentos->last()->only('latitude', 'longitude')
            : $ordemServico->rastreamentos->map->only(['latitude', 'longitude']);
        $data = [
            'orden_servico_id' => $ordemServico->id,
            'rastreamentos' => $rastreamentos,
        ];

        return response([
            'data' => $data,
            'status' => true
        ], 200);
    }
}
