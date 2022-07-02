<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnidadeRequest;
use App\Http\Resources\UnidadeResource;
use App\Models\Unidade;
use Illuminate\Http\Request;


class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidad = Unidade::all();

        return response([
            'data' => UnidadeResource::collection($unidad),
            'status' => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UnidadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnidadeRequest $request)
    {
        $unidad = Unidade::create($request->all());
        
        return response([
            'data' => new UnidadeResource($unidad),
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
            'data' => new UnidadeResource(Unidade::find($id)),
            'status' => true
        ], 200);
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UnidadRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnidadeRequest $request, $id)
    {
        $unidad = Unidade::find($id);
        $unidad->update($request->all());
         return response([
            'data' => new UnidadeResource($unidad),
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
        Unidad::findOrFail($id)->delete();
        return response(null, 204);
    }
}
