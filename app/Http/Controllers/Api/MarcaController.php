<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarcaRequest;
use App\Http\Resources\MarcaResource;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $marca = Marca::all();
        return response([
            'data' => MarcaResource::collection($marca),
            'status' => true
        ], 200);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\MarcaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcaRequest $request)
    {
        $marca = Marca::create($request->all());
         return response([
            'data' => new MarcaResource($marca),
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
            'data' => new MarcaResource(Marca::find($id)),
            'status' => true
        ], 200);
    }
    /**
      * Update the specified resource in storage.
     *
     * @param  app\Http\Requests\MarcaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MarcaRequest $request, $id)
    {   
        $marca = Marca::find($id);
        $marca->update($request->all());
        return response([
            'data' => new MarcaResource($marca),
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
        Marca::findOrFail($id)->delete();
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
        $marca = Marca::find($id);
        if ($request->has('ativo') && in_array($request->ativo, [1, 0])) {
            $marca->update($request->all());
            $status = true;
        }

        return response([
            'status' => $status
        ], 200);
    }
}
