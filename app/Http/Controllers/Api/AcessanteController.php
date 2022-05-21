<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAcessanteRequest;
use App\Http\Resources\AcessanteResource;
use App\Models\Acessante;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class AcessanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $acessante = Acessante::all();
        return AcessanteResource::collection($acessante);
        // return $acessante;
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
            'cpf' => 'required|string|max:50',
            'rg' => 'required|string|max:50',
            'nome' => 'required|string|max:50',
            'email' => 'required|string|max:40',
            'cargo' => 'required|string|max:40',
            'celular' => 'required|string|max:15',
            'fixo' => 'required|string|max:15',
            'whats' => 'required|string|max:15',
            'endereco' => 'required|string|max:50',
            'numero' => 'required|string|max:4',
            'complemento' => 'required|string|max:30',
            'cep' => 'required|string|max:10',
            'bairro' => 'required|string|max:20',
            'cidade' => 'required|string|max:45',
            'estado' => 'required|string|max:2',
            'registro_carteira' => 'required|string|max:30',
            'validade_carteira' => 'required|date|date_format:Y-m-d',
            'tipo_carteira' => 'required|string|max:50',
            'identificador_celular' => 'required|string|max:20',
            'senha_acesso' => 'required|string|max:10'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $acessante = Acessante::create($request->all());
        return new AcessanteResource($acessante);
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
        return new AcessanteResource(Acessante::find($id));
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
            'cpf' => 'required|string|max:50',
            'rg' => 'required|string|max:50',
            'nome' => 'required|string|max:50',
            'email' => 'required|string|max:40',
            'cargo' => 'required|string|max:40',
            'celular' => 'required|string|max:15',
            'fixo' => 'required|string|max:15',
            'whats' => 'required|string|max:15',
            'endereco' => 'required|string|max:50',
            'numero' => 'required|string|max:4',
            'complemento' => 'required|string|max:30',
            'cep' => 'required|string|max:10',
            'bairro' => 'required|string|max:20',
            'cidade' => 'required|string|max:45',
            'estado' => 'required|string|max:2',
            'registro_carteira' => 'required|string|max:30',
            'validade_carteira' => 'required|date|date_format:Y-m-d',
            'tipo_carteira' => 'required|string|max:50',
            'identificador_celular' => 'required|string|max:20',
            'senha_acesso' => 'required|string|max:10'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        
        $acessante = Acessante::find($id);
        $acessante->update($request->all());
        return new AcessanteResource($acessante);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $acessante = Acessante::findOrFail($id);
        $acessante->delete();
        return response(null, 204);
    }
}
