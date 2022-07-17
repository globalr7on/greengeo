<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotaFiscalRequest;
use App\Http\Resources\NotaFiscalResource;
use App\Models\NotaFiscal;
use App\Models\NotaFiscalIten;
use Illuminate\Http\Request;

class NotaFiscalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index(Request $request)
    {
        $nota = NotaFiscal::all();
        $itens = NotaFiscalIten::all();

        return response([
            'data' => NotaFiscalResource::collection($nota, $itens),
            'status' => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\NotaFiscalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotaFiscalRequest $request)
    {
        $nota = NotaFiscal::create($request->all());
        return response([
            'data' => new NotaFiscalResource($nota),
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
            'data' => new NotaFiscalResource(NotaFiscal::find($id)),
            'status' => true
        ], 200);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\NotaFiscalRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NotaFiscalRequest $request, $id)
    {
        $nota = NotaFiscal::find($id);
        $nota->update($request->all());

        return response([
            'data' => new NotaFiscalResource($nota),
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
        NotaFiscal::findOrFail($id)->delete();
        return response(null, 204);
    }
}
