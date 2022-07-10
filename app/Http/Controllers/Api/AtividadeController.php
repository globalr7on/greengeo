<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AtividadeRequest;
use App\Http\Resources\AtividadeResource;
use App\Models\Atividade;
use Illuminate\Http\Request;

class AtividadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atividade = Atividade::all();
         return response([
            'data' => AtividadeResource::collection($atividade),
            'status' => true
        ], 200);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  app\Http\Requests\AtividadeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AtividadeRequest $request)
    {
        $atividade = Atividade::create($request->all());
        return response([
            'data' => new AtividadeResource($atividade),
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
            'data' => new AtividadeResource(Atividade::find($id)),
            'status' => true
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\AtividadeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $atividade = Atividade::find($id);
        $atividade->update($request->all());
         return response([
            'data' => new AtividadeResource($atividade),
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
        Atividade::findOrFail($id)->delete();
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
        $atividade = Atividade::find($id);
        if ($request->has('ativo') && in_array($request->ativo, [1, 0])) {
            $atividade->update($request->all());
            $status = true;
        }

        return response([
            'status' => $status
        ], 200);
    }
}
