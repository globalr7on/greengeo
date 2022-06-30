<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\TipoMaterialRequest;
use App\Http\Resources\TipoMaterialResource;
use App\Models\TipoMaterial;
use Illuminate\Http\Request;


class TipoMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_material = TipoMaterial::all();
       
          return response([
            'data' => TipoMaterialResource::collection($tipo_material),
            'status' => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\TipoMaterialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoMaterialRequest $request)
    {
        
        $tipo_material = TipoMaterial::create($request->all());
          return response([
            'data' => new TipoMaterialResource($tipo_material),
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
            'data' => new TipoMaterialResource(TipoMaterial::find($id)),
            'status' => true
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\TipoMaterialRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoMaterialRequest $request, $id)
    { 
        $tipo_material = TipoMaterial::find($id);
        $tipo_material->update($request->all());
         return response([
            'data' => new TipoMaterialResource($tipo_material),
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
        TipoMaterial::findOrFail($id)->delete();
        return response(null, 204);
    }
}
