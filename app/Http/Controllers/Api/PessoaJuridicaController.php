<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\PessoaJuridicaRequest;
use App\Http\Resources\PessoaJuridicaResource;
use App\Models\PessoaJuridica;
use App\Models\Acessante;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class PessoaJuridicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pessoa_juridica = PessoaJuridica::all();
        return PessoaJuridicaResource::collection($pessoa_juridica);
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
            'tipo' => 'required|string|max:14',
            'cnpj' => 'required|string|max:18',
            'nome_fantasia' => 'required|string|max:50',
            'razao_social' => 'required|string|max:50',
            'email' => 'required|string|max:40',
            'contato_1' => 'required|string|max:15',
            'cargo_contato_1' => 'required|string|max:40',
            'contato_2' => 'required|string|max:15',
            'contato_2' => 'required|string|max:15',
            'cargo_contato_2' => 'required|string|max:40',
            'celular_contato_1' => 'required|string|max:30',
            'celular_contato_2' => 'required|string|max:15',
            'fixo' => 'required|string|max:20',
            'whatsapp' => 'required|string|max:45',
            'endereco' => 'required|string|max:50',
            'numero' => 'required|string|max:30',
            'complemento' => 'required|string|max:30',
            'cep' => 'required|string|max:10',
            'bairro' => 'required|string|max:20',
            'cidade' => 'required|string|max:10',
            'estado' => 'required|string|max:2',
            'latitude' => 'required|string|max:10',
            'longitude' => 'required|string|max:10',
            'contrato' => 'required|string|max:10',
            'ativo' => 'required|string|max:10',
            'identificador_celular' => 'required|string|max:10',
            'senha_acesso' => 'required|string|max:10',
            'capacidade_media_carga' => 'required|numeric|between:1,999999.99',
            'usuario_responsavel_cadastro_id' => 'required|string',
        
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        // // $acessanteid = $request['usuario_responsavel_cadastro_id'];
        // // $acessante=Acessante::find($acessanteid);

        // $acessanteid = PessoaJuridica::with('getAcessantes')->get();
        // dd($acessanteid);
        // die;
        // if(!$acessante){
        //     return response()->json(['usuario_responsavel_cadastro_id'=>'No existe']); 
        // }

        $pessoa_juridica = PessoaJuridica::create($request->all());
        return new PessoaJuridicaResource($pessoa_juridica);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return new PessoaJuridicaResource(PessoaJuridica::find($id));
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
            'tipo' => 'required|string|max:14',
            'cnpj' => 'required|string|max:18',
            'nome_fantasia' => 'required|string|max:50',
            'razao_social' => 'required|string|max:50',
            'email' => 'required|string|max:40',
            'contato_1' => 'required|string|max:15',
            'cargo_contato_1' => 'required|string|max:40',
            'contato_2' => 'required|string|max:15',
            'contato_2' => 'required|string|max:15',
            'cargo_contato_2' => 'required|string|max:40',
            'celular_contato_1' => 'required|string|max:30',
            'celular_contato_2' => 'required|string|max:15',
            'fixo' => 'required|string|max:20',
            'whatsapp' => 'required|string|max:45',
            'endereco' => 'required|string|max:50',
            'numero' => 'required|string|max:30',
            'complemento' => 'required|string|max:30',
            'cep' => 'required|string|max:10',
            'bairro' => 'required|string|max:20',
            'cidade' => 'required|string|max:10',
            'estado' => 'required|string|max:2',
            'latitude' => 'required|string|max:10',
            'longitude' => 'required|string|max:10',
            'contrato' => 'required|string|max:10',
            'ativo' => 'required|string|max:10',
            'identificador_celular' => 'required|string|max:10',
            'senha_acesso' => 'required|string|max:10',
            'capacidade_media_carga' => 'required',
            'usuario_responsavel_cadastro_id' => 'required|string|max:10',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $pessoa_juridica = PessoaJuridica::find($id);
        $pessoa_juridica->update($request->all());
        return new PessoaJuridicaResource($pessoa_juridica);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pessoa_juridica = PessoaJuridica::findOrFail($id);
        $pessoa_juridica->delete();
        return response(null, 204);
    }
}
