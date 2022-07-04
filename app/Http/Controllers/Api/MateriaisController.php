<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MateriaisRequest;
use App\Http\Resources\MateriaisResource;
use App\Models\Material;
use Illuminate\Http\Request;

class MateriaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $material = Material::all();
        //  dd($material);
         return response([
            'data' => MateriaisResource::collection($material),
            'status' => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\MateriaisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MateriaisRequest $request)
    {
        $material = Material::create($request->all());
        return response([
            'data' => new MateriaisResource($material),
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
            'data' => new MateriaisResource(Material::find($id)),
            'status' => true
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProdutoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, $id)
    {
        $material = Material::find($id);
        $material->update($request->all());
           return response([
            'data' => new MaterialResource($material),
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
        Material::findOrFail($id)->delete();
        return response(null, 204);
    }
}
