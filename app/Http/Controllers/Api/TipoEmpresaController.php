<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\TipoEmpresaRequest;
use App\Http\Resources\TipoEmpresaResource;
use App\Models\TipoEmpresa;
use Illuminate\Http\Request;


class TipoEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_empresa = TipoEmpresa::all();
       
          return response([
            'data' => TipoEmpresaResource::collection($tipo_empresa),
            'status' => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\TipoEmpresaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoEmpresaRequest $request)
    {
        
        $tipo_empresa = TipoEmpresa::create($request->all());
          return response([
            'data' => new TipoEmpresaResource($tipo_empresa),
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
            'data' => new TipoEmpresaResource(TipoEmpresa::find($id)),
            'status' => true
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\TipoEmpresaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoEmpresaRequest $request, $id)
    { 
        $tipo_empresa = TipoEmpresa::find($id);
        $tipo_empresa->update($request->all());
         return response([
            'data' => new TipoEmpresaResource($tipo_empresa),
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
        TipoEmpresa::findOrFail($id)->delete();
        return response(null, 204);
    }
}
