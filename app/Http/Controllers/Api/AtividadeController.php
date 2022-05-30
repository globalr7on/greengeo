<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AtividadeRequest;
use App\Http\Resources\AtividadeResource;
use App\Models\Atividade;
// use App\Models\TipoAcessante;
use Illuminate\Http\Request;
use Validator;

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

        return AtividadeResource::collection($atividade);
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
            'descricao' => 'required|string|max:15',
            // 'ativo' => 'required|string|max:15',
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $atividade = Atividade::create($request->all());
        
        // $tipo_acessantes= TipoAcessante::all();
        // $atividade->tipo_acessantes()->attach($tipo_acessantes);
        return new AtividadeResource($atividade);
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
       return new AtividadeResource(Atividade::find($id));
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
            'descricao' => 'required|string|max:14',
            'ativo' => 'required|string|max:15',
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        
        $atividade = Atividade::find($id);
        $atividade->update($request->all());
        return new AtividadeResource($atividade);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $atividade = Atividade::findOrFail($id);
        // $tipo_acessantes= TipoAcessante::all();
        // $atividade->tipo_acessantes()->detach($tipo_acessantes);
        $atividade->delete();
        return response(null, 204);
    }
}
