<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgendamentoRequest;
use App\Http\Resources\AgendamentoResource;
use App\Models\Agendamento;

use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendamentos = Agendamento::all();
        return response([
            'data' => AgendamentoResource::collection($agendamentos),
            'status' => true
        ], 200);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  app\Http\Requests\AgendamentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgendamentoRequest $request)
    {
        $agendamentos = Agendamento::create($request->all());
        return response([
            'data' => new AgendamentoResource($agendamentos),
            'status' => true
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response([
            'data' => new AgendamentoResource(Agendamento::find($id)),
            'status' => true
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\AgendamentoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $agendamentos = Agendamento::find($id);
        $agendamentos->update($request->all());
        return response([
            'data' => new AgendamentosResource($agendamentos),
            'status' => true
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Agendamento::findOrFail($id)->delete();
        return response(null, 204);
    }

    /**
     * Update status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $status = false;
        $agendamento = Agendamento::find($id);
        if ($request->has('ativo') && in_array($request->ativo, [1, 0])) {
            $atividade->update($request->all());
            $status = true;
        }

        return response([
            'status' => $status
        ], 200);
    }
}
