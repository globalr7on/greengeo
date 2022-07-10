<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TratamentoRequest;
use App\Http\Resources\TratamentoResource;
use App\Models\Tratamento;
use Illuminate\Http\Request;

class TratamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tratamento = Tratamento::all();
        return response([
            'data' => TratamentoResource::collection($tratamento),
            'status' => true
        ], 200);
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  app\Http\Requests\TratamentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TratamentoRequest $request)
    {
        $tratamento = Tratamento::create($request->all());
        return response([
            'data' => new TratamentoResource($tratamento),
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
            'data' => new TratamentoResource(Tratamento::find($id)),
            'status' => true
        ], 200);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  app\Http\Requests\TratamentoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TratamentoRequest $request, $id)
    {
        $tratamento = Tratamento::find($id);
        $tratamento->update($request->all());
        return response([
            'data' => new TratamentoResource($tratamento),
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
       Tratamento::findOrFail($id)->delete();
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
        $tratamento = Tratamento::find($id);
        if ($request->has('ativo') && in_array($request->ativo, [1, 0])) {
            $tratamento->update($request->all());
            $status = true;
        }

        return response([
            'status' => $status
        ], 200);
    }
}
