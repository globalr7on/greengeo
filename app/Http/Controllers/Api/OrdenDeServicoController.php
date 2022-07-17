<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\OrdenDeServicoRequest;
use App\Http\Resources\OrdenDeServicoResource;
use App\Models\OrdensServicos;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class OrdenDeServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'data' => OrdenDeServicoResource::collection(OrdensServicos::all()),
            'status' => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\OrdenDeServicoRequest  $request
     * @return \Illuminate\Http\Response
     */

     public function store(OrdenDeServicoRequest $request)
    {
        try {
            $newOrdenDeServico = new OrdenDeServicoResource(OrdensServicos::create($request->all()));
            try {
                $responseRastreo = Http::post(env('RASTREAMENTO').'coordenada/create', [
                    "codigo_coordenada" => $newOrdenDeServico->id,
                    "gerador" => [
                        "id" => $newOrdenDeServico->gerador_id,
                        "latitude" => $newOrdenDeServico->gerador_coord ? $newOrdenDeServico->gerador_coord->lat : null,
                        "longitude" => $newOrdenDeServico->gerador_coord ? $newOrdenDeServico->gerador_coord->lng : null,
                    ],
                    "destinador" => [
                        "id" => $newOrdenDeServico->destinador_id,
                        "latitude" => $newOrdenDeServico->destinador_coord ? $newOrdenDeServico->destinador_coord->lat : null,
                        "longitude" => $newOrdenDeServico->destinador_coord ? $newOrdenDeServico->destinador_coord->lng : null,
                    ]
                ]);
            } catch(Exception $e) {
                echo 'Error Message: ' .$e->getMessage();
            }

            return response([
                'data' =>  $newOrdenDeServico,
                'status' => true
            ], 200);
        } catch(Exception $error) {
            return response([
                'data' =>  $error->getMessage(),
                'status' => false
            ], 400);
        }
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
            'data' => new OrdenDeServicoResource(OrdensServicos::find($id)),
            'status' => true
        ], 200);
    }

  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\OrdenDeServicoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrdenDeServicoRequest $request, $id)
    {
        $orden_servico = OrdensServicos::find($id);
        $orden_servico->update($request->all());
           return response([
            'data' => new OrdenDeServicoResource($orden_servico),
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
        OrdensServicos::findOrFail($id)->delete();
        return response(null, 204);
    }
}
