<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModeloRequest;
use App\Http\Resources\ModeloResource;
use App\Models\Modelo;
use Illuminate\Http\Request;


class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $modelo = Modelo::all();
        return response([
            'data' => ModeloResource::collection($modelo),
            'status' => true
        ], 200);
        // return $acessante;
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ModeloRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModeloRequest $request)
    {
        $modelo = Modelo::create($request->all());
         return response([
            'data' => new ModeloResource($modelo),
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
            'data' => new ModeloResource(Modelo::find($id)),
            'status' => true
        ], 200);
    }

    /**
      * Update the specified resource in storage.
     *
     * @param  app\Http\Requests\ModeloRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModeloRequest $request, $id)
    {   
        $modelo = Modelo::find($id);
        $modelo->update($request->all());
        return response([
                'data' => new ModeloResource($modelo),
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
        Modelo::findOrFail($id)->delete();
        return response(null, 204);
    }
}
