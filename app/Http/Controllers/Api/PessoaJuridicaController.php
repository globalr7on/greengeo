<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\PessoaJuridicaRequest;
use App\Http\Resources\PessoaJuridicaResource;
use App\Models\PessoaJuridica;
use App\Models\User;
use Illuminate\Http\Request;


class PessoaJuridicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pessoa_juridica = PessoaJuridica::all();

        if ($request->has('usuario_responsavel_cadastro_id')) {
            $userResponsavel = User::find($request->usuario_responsavel_cadastro_id);
            if (!$userResponsavel->hasRole('admin')) {
                $pessoa_juridica = $pessoa_juridica->where('usuario_responsavel_cadastro_id', $request->usuario_responsavel_cadastro_id)->all();
            }
        }

        if ($request->has('tipo_empresa_id')) {
            $pessoa_juridica = $pessoa_juridica->where('tipo_empresa_id', $request->tipo_empresa_id)->all();
        }

         return response([
            'data' => PessoaJuridicaResource::collection($pessoa_juridica),
            'status' => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PessoaJuridicaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PessoaJuridicaRequest $request)
    {
        $pessoa_juridica = PessoaJuridica::create($request->all());
        return response([
            'data' => new PessoaJuridicaResource($pessoa_juridica),
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
            'data' => new PessoaJuridicaResource(PessoaJuridica::find($id)),
            'status' => true
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PessoaJuridicaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PessoaJuridicaRequest $request, $id)
    {
        $pessoa_juridica = PessoaJuridica::find($id);
        $pessoa_juridica->update($request->all());
        return response([
            'data' => new PessoaJuridicaResource($pessoa_juridica),
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
        PessoaJuridica::findOrFail($id)->delete();
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
        $pessoa_juridica = PessoaJuridica::find($id);
        if ($request->has('ativo') && in_array($request->ativo, [1, 0])) {
            $pessoa_juridica->update($request->all());
            $status = true;
        }

        return response([
            'status' => $status
        ], 200);
    }
}
