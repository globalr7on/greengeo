<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAcessanteRequest;
use App\Http\Resources\AcessanteResource;
use App\Models\Acessante;
use App\Models\User;
use Illuminate\Http\Request;

class AcessanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
           
        // $acessante = Acessante::all();
        // return AcessanteResource::collection($acessante);
        return view('cadastros.acessante');
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAcessanteRequest $request)
    {
       
            // $acessante = Acessante::create($request->all());
            return json_decode('{"hugo":"portu"}');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acessante  $acessante
     * @return \Illuminate\Http\Response
     */
    public function show(Acessante $acessante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acessante  $acessante
     * @return \Illuminate\Http\Response
     */
    public function edit(Acessante $acessante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Acessante  $acessante
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAcessanteRequest $request, Acessante $acessante)
    {
        
        $acessante->update($request->all());
        
        return $acessante;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acessante  $acessante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acessante $acessante)
    {
        $acessante->delete();
        return response(null, 204);
    }
}
