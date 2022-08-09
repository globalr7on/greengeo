<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\PessoaJuridicaRequest;
use App\Http\Resources\PessoaJuridicaResource;
use App\Models\PessoaJuridica;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PessoaJuridicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */  
    public function index(Request $request)
    {
        $currentUser = auth()->user()
        $showCurrentEmpresa = $request->boolean('show_current_empresa', true);
        $currentPessoaJuridicaId = $currentUser->pessoa_juridica_id;
        $currentUserPessoaJuridica = $currentPessoaJuridicaId && $showCurrentEmpresa ? PessoaJuridica::find($currentPessoaJuridicaId) : new PessoaJuridica;
        $pessoaJuridica = PessoaJuridica::all();
        if ($request->has('usuario_responsavel_cadastro_id')) {
            $userResponsavel = User::find($request->usuario_responsavel_cadastro_id);
            if (!$userResponsavel->hasRole('admin')) {
                $pessoaJuridica = $pessoaJuridica->where('usuario_responsavel_cadastro_id', $request->usuario_responsavel_cadastro_id);
            }
        }
        
        if ($request->has('tipo_empresa_id')) {
            $pessoaJuridica = $pessoaJuridica->where('tipo_empresa_id', $request->tipo_empresa_id)->where('usuario_responsavel_cadastro_id', $currentUser->id);;
        }
        $pessoaJuridica = collect($pessoaJuridica)->merge(collect([$currentUserPessoaJuridica]))->unique()->filter(function ($value) { return $value->id; });

        return response([
            'data' => PessoaJuridicaResource::collection($pessoaJuridica),
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
        $pessoaJuridica = PessoaJuridica::create($request->all());
        return response([
            'data' => new PessoaJuridicaResource($pessoaJuridica),
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
        $pessoaJuridica = PessoaJuridica::find($id);
        $pessoaJuridica->update($request->all());
        return response([
            'data' => new PessoaJuridicaResource($pessoaJuridica),
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
        $pessoaJuridica = PessoaJuridica::find($id);
        if ($request->has('ativo') && in_array($request->ativo, [1, 0])) {
            $pessoaJuridica->update($request->all());
            $status = true;
        }

        return response([
            'status' => $status
        ], 200);
    }
}
