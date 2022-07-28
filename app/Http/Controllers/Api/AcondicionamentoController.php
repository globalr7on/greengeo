<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcondicionamentoRequest;
use App\Http\Resources\AcondicionamentoResource;
use App\Models\Acondicionamento;
use Illuminate\Http\Request;


class AcondicionamentoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $acondicionamento = Acondicionamento::all();
        return response([
            'data' => AcondicionamentoResource::collection($acondicionamento),
            'status' => true
        ], 200);
        // return $acessante;
    }

     /**
     * Store a newly created resource in storage.
     *
     *  @param  app\Http\Requests\AcondicionamentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcondicionamentoRequest $request)
    {
        $acondicionamento = Acondicionamento::create($request->all());
        return response([
            'data' => new AcondicionamentoResource($acondicionamento),
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
            'data' => new AcondicionamentoResource(Acondicionamento::find($id)),
            'status' => true
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
   
     * @param  app\Http\Requests\AcondicionamentoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AcondicionamentoRequest $request, $id)
    {
        $acondicionamento = Acondicionamento::find($id);
        $acondicionamento->update($request->all());
        return response([
            'data' => new AcondicionamentoResource($acondicionamento),
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
        Acondicionamento::findOrFail($id)->delete();
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
        $acondicionamento = Acondicionamento::find($id);
        if ($request->has('ativo') && in_array($request->ativo, [1, 0])) {
            $acondicionamento->update($request->all());
            $status = true;
        }

        return response([
            'status' => $status
        ], 200);
    }
}
