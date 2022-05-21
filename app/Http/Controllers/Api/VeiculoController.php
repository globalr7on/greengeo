<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VeiculoRequest;
use App\Http\Resources\VeiculoResource;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Validator;

class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $veiculo = Veiculo::all();
        return VeiculoResource::collection($veiculo);
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
            
            'chassis' => 'required|string|max:14',
            'placa' => 'required|string|max:18',
            'capacidade_media_carga' => 'required|string|max:50',
            'renavam' => 'required|string|max:50',
            'combustivel' => 'required|string|max:40',
            'modelos_id' => 'required|string|max:1',
            'marcas_id' => 'required|string|max:1',
            'acondicionamento_id' => 'required|string|max:1',
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $veiculo = Veiculo::create($request->all());
        return new VeiculoResource($veiculo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new VeiculoResource(Veiculo::find($id));
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

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            
            'chassis' => 'required|string|max:14',
            'placa' => 'required|string|max:18',
            'capacidade_media_carga' => 'required|string|max:50',
            'renavam' => 'required|string|max:50',
            'combustivel' => 'required|string|max:40',
            'modelos_id' => 'required|string|max:1',
            'marcas_id' => 'required|string|max:1',
            'acondicionamento_id' => 'required|string|max:1',
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $veiculo = Veiculo::find($id);
        $veiculo->update($request->all());
        return new VeiculoResource($veiculo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $veiculo = Veiculo::findOrFail($id);
        $veiculo->delete();
        return response(null, 204);
    }
}
