<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\TipoMaterialRequest;
use App\Http\Resources\TipoMaterialResource;
use App\Models\TipoMaterial;
// use App\Models\TipoAcessante;
use Illuminate\Http\Request;
use Validator;

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
       
        // dd($acondicionamento);
        return TipoMaterialResource::collection($tipo_material);
        // return $acessante;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descricao' => 'required|string|max:45',
            // 'ativo' => 'required|string|max:15',
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $tipo_material = TipoMaterial::create($request->all());
        // dd($acondicionamento);
        return new TipoMaterialResource($tipo_material);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $acessante = Acessante::findOrFail($id);
        return new TipoMaterialResource(TipoMaterial::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'descricao' => 'required|string|max:45',
            'ativo' => 'required|string|max:15',
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        
        $tipo_material = TipoMaterial::find($id);
        $tipo_material->update($request->all());
        return new TipoMaterialResource($tipo_material);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_material = TipoMaterial::findOrFail($id);
        $tipo_material->delete();
        return response(null, 204);
    }
}
