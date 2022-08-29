<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgendamentoRequest;
use App\Http\Resources\AgendamentoResource;
use App\Models\Agendamento;
use App\Mail\EnvioAgendamento;
use Validator;
use Hash;
use Mail;

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
        $agendamento = Agendamento::create($request->all());
        $codigo = $agendamento->ordem_servico->codigo;
        $gerador = $agendamento->usuario->pessoa_juridica->nome_fantasia;
        $descricao_produto = $agendamento->ordem_servico->description;
        $peso_total = $agendamento->ordem_servico->peso_total;
        $transportadora = $agendamento->transportadora->nome_fantasia;
        $acondicionamento = $agendamento->acondicionamento->descricao;
        $email = $agendamento->transportadora->email;
        $coleta = $agendamento->coleta;
        Mail::to($email)->send(new EnvioAgendamento($codigo, $transportadora, $acondicionamento, $descricao_produto, $peso_total, $coleta));
        return response([
            'data' => new AgendamentoResource($agendamento),
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
