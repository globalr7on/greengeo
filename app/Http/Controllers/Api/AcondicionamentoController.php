<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcondicionamentoRequest;
use App\Http\Resources\AcondicionamentoResource;
use App\Models\Acondicionamento;
use Illuminate\Http\Request;
use Validator;

class AcondicionamentoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $acondicionamento = Acondicionamento::all();
        // dd($acondicionamento);
        return AcondicionamentoResource::collection($acondicionamento);
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
            'descricao' => 'required|string|max:45',
            // 'ativo' => 'required|string|max:15',
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $acondicionamento = Acondicionamento::create($request->all());
        // dd($acondicionamento);
        return new AcondicionamentoResource($acondicionamento);
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
        return new AcondicionamentoResource(Acondicionamento::find($id));
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
            // 'ativo' => 'required|string|max:15',
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        
        $acondicionamento = Acondicionamento::find($id);
        $acondicionamento->update($request->all());
        return new AcondicionamentoResource($acondicionamento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $acondicionamento = Acondicionamento::findOrFail($id);
        $acondicionamento->delete();
        return response(null, 204);
    }
}


