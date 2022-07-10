<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstagiosOsRequest;
use App\Http\Resources\EstagiosOsResource;
use App\Models\Estagio;
use Illuminate\Http\Request;


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
        return response([
            'data' => EstagiosOsResource::collection($estagios_os),
            'status' => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\EstagiosOsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstagiosOsRequest $request)
    {
        $estagios_os = Estagio::create($request->all());
        return response([
            'data' => new EstagiosOsResource($estagios_os),
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
            'data' => new EstagiosOsResource(Estagio::find($id)),
            'status' => true
        ], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\EstagiosOsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EstagiosOsRequest $request, $id)
    {
        
        $estagios_os = Estagio::find($id);
        $estagios_os->update($request->all());
        return response([
            'data' => new EstagiosOsResource($estagios_os),
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
        Estagio::findOrFail($id)->delete();
        return response(null, 204);
    }
}
