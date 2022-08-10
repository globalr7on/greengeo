<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VeiculoRequest;
use App\Http\Resources\VeiculoResource;
use App\Models\Veiculo;
use Illuminate\Http\Request;


class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  app\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $veiculos = Veiculo::all();
        if ($request->has('pessoa_juridica_id')) {
            $veiculos = $veiculos->where('pessoa_juridica_id', $request->pessoa_juridica_id)->all();
        }
        return response([
            'data' => VeiculoResource::collection($veiculos),
            'status' => true
        ], 200);
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\VeiculoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VeiculoRequest $request)
    {
        $veiculo = Veiculo::create($request->all());
        return response([
            'data' => new VeiculoResource($veiculo),
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
            'data' => new veiculoResource(veiculo::find($id)),
            'status' => true
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VeiculoRequest $request, $id)
    {
        $veiculo = Veiculo::find($id);
        $veiculo->update($request->all());
        return response([
            'data' => new VeiculoResource($veiculo),
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
        Veiculo::findOrFail($id)->delete();
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
        $veiculo = Veiculo::find($id);
        if ($request->has('ativo') && in_array($request->ativo, [1, 0])) {
            $veiculo->update($request->all());
            $status = true;
        }

        return response([
            'status' => $status
        ], 200);
    }
}
