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
        return response([
            'data' => ClasseSucataResource::collection($classe_sucata),
            'status' => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  app\Http\Requests\ClasseSucataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClasseSucataRequest $request)
    {
      
        $classe_sucata = ClasseSucata::create($request->all());
        return response([
                'data' => new ClasseSucataResource($classe_sucata),
                'status' => true
            ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response([
            'data' => new ClasseSucataResource(ClasseSucata::find($id)),
            'status' => true
        ], 200);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  app\Http\Requests\ClasseSucataRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClasseSucataRequest $request, $id)
    {

        $classe_sucata = ClasseSucata::find($id);
        $classe_sucata->update($request->all());
        return response([
            'data' => new ClasseSucataResource($classe_sucata),
            'status' => true
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       ClasseSucata::findOrFail($id)->delete();
       return response(null, 204);
    }
}
