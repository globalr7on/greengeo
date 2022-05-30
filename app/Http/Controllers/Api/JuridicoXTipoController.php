<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JuridicoXTipoRequest;
use App\Http\Resources\JuridicoXTipoResource;
use App\Models\JuridicoXTipo;
use Illuminate\Http\Request;
use Validator;

class JuridicoXTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $juridica_x_tipo = JuridicoXTipo::all();
        return JuridicoXTipoResource::collection($juridica_x_tipo);
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
        // $validator = Validator::make($request->all(), [
        //     'descricao' => 'required|string|max:45',
        //     // 'ativo' => 'required|string|max:15',
            
        // ]);

        // if($validator->fails()){
        //     return response()->json($validator->errors());       
        // }

        $juridica_tipo = JuridicoXTipo::create($request->all());
        return new JuridicoXTipoResource($juridica_tipo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new JuridicoXTipoResource(JuridicoXTipo::find($id));
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
        // $validator = Validator::make($request->all(), [
        //     'descricao' => 'required|string|max:45',
        //     'ativo' => 'required|string|max:15',
            
        // ]);

        // if($validator->fails()){
        //     return response()->json($validator->errors());       
        // }
        
        $juridica_tipo = JuridicaXTipo::find($id);
        $juridica_tipo->update($request->all());
        return new JuridicoXTipoResource($juridica_tipo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $juridica_tipo = JuridicoXTipo::findOrFail($id);
        $juridica_tipo->delete();
        return response(null, 204);
    }
}
