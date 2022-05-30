<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoAcessanteRequest;
use App\Http\Resources\TipoAcessanteResource;
use App\Models\TipoAcessante;
// use App\Models\Atividade;
use Illuminate\Http\Request;
use Validator;


class TipoAcessanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tipo_acessante = TipoAcessante::all();
        return TipoAcessanteResource::collection($tipo_acessante);
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

        $tipo_acessante = TipoAcessante::create($request->all());
        // $atividades= Atividade::all();
        // $tipo_acessante->atividades()->attach($atividades);
        // dd($acondicionamento);
        return new TipoAcessanteResource($tipo_acessante);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new TipoAcessanteResource(TipoAcessante::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        
        $tipo_acessante = TipoAcessante::find($id);
        $tipo_acessante->update($request->all());
        return new TipoAcessanteResource($tipo_acessante);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_acessante = TipoAcessante::findOrFail($id);
        // $atividades= Atividade::all();
        // $tipo_acessante->atividades()->detach($atividades);
        $tipo_acessante->delete();
        return response(null, 204);
    }
}
