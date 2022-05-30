<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstagiosOsRequest;
use App\Http\Resources\EstagiosOsResource;
use App\Models\Estagio;
use Illuminate\Http\Request;
use Validator;

class EstagiosOsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estagios_os = Estagio::all();
        // dd($acondicionamento);
        return EstagiosOsResource::collection($estagios_os);
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
          
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $estagios_os = Estagio::create($request->all());
        // dd($acondicionamento);
        return new EstagiosOsResource($estagios_os);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new EstagiosOsResource(Estagio::find($id));
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
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        
        $estagios_os = Estagio::find($id);
        $estagios_os->update($request->all());
        return new EstagiosOsResource($estagios_os);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estagios_os = Estagio::findOrFail($id);
        $estagios_os->delete();
        return response(null, 204);
    }
}
