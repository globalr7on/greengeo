<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClasseSucataRequest;
use App\Http\Resources\ClasseSucataResource;
use App\Models\ClasseSucata;
// use App\Models\TipoAcessante;
use Illuminate\Http\Request;
use Validator;

class ClasseSucataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classe_sucata = ClasseSucata::all();
        // dd($acondicionamento);
        return ClasseSucataResource::collection($classe_sucata);
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

        $classe_sucata = ClasseSucata::create($request->all());
        // dd($acondicionamento);
        return new ClasseSucataResource($classe_sucata);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ClasseSucataResource(ClasseSucata::find($id));
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
        
        $classe_sucata = ClasseSucata::find($id);
        $classe_sucata->update($request->all());
        return new ClasseSucataResource($classe_sucata);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classe_sucata = ClasseSucata::findOrFail($id);
        $classe_sucata->delete();
        return response(null, 204);
    }
}
