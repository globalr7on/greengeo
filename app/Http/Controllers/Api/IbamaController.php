<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IbamaRequest;
use App\Http\Resources\IbamaResource;
use App\Models\Ibama;
use Illuminate\Http\Request;

class IbamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ibama = Ibama::all();
        return response([
            'data' => IbamaResource::collection($ibama),
            'status' => true
        ], 200);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\IbamaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IbamaRequest $request)
    {
        $ibama = Ibama::create($request->all());
        return response([
            'data' => new IbamaResource($ibama),
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
            'data' => new IbamaResource(Ibama::find($id)),
            'status' => true
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\IbamaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IbamaRequest $request, $id)
    {
        $ibama = Ibama::find($id);
        $ibama->update($request->all());
        return response([
            'data' => new IbamaResource($ibama),
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
        Ibama::findOrFail($id)->delete();
        return response(null, 204);
    }
}
