<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\OrdenDeServicoRequest;
use App\Http\Resources\OrdenDeServicoResource;
use App\Models\OrdensServicos;
use App\Models\PessoaJuridica;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class OrdenDeServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->hasRole('admin')) {
            $orden_servico = OrdensServicos::all();
        }else {
            $current_usuario_id = auth()->user()->id;
            if (auth()->user()->hasRole('motorista')) {
                $orden_servico = OrdensServicos::where('motorista_id', $current_usuario_id)->get();
            } else {
                $current_empresa_id = auth()->user()->pessoa_juridica_id;
                $current_tipo_empresa = auth()->user()->pessoa_juridica && auth()->user()->pessoa_juridica->tipo_empresa ?  auth()->user()->pessoa_juridica->tipo_empresa->descricao : null;
                if ($current_tipo_empresa == 'Gerador') {
                    $orden_servico = OrdensServicos::where('gerador_id', $current_empresa_id)->get();
                } elseif ($current_tipo_empresa == 'Destinador') {
                    $orden_servico = OrdensServicos::where('destinador_id', $current_empresa_id)->get();
                } elseif ($current_tipo_empresa == 'Transportador') {
                    $orden_servico = OrdensServicos::where('transportador_id', $current_empresa_id)->get();
                } elseif ($current_tipo_empresa == 'GDT') {
                    $orden_servico = OrdensServicos::where('gerador_id', $current_empresa_id)
                                            ->orWhere('destinador_id', $current_empresa)
                                            ->orWhere('transportador_id',  $current_empresa)
                                            ->get();
                }
            }
        }
       
        return response([
            'data' =>OrdenDeServicoResource::collection($orden_servico),
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
            $newOrdenDeServico = OrdensServicos::create($request->all());
            
            try {
                $responseRastreo = Http::post(config('app.rastreamento').'coordenada/create', [
                    "codigo_coordenada" => $newOrdenDeServico->id,
                    "gerador" => [
                        "id" => $newOrdenDeServico->gerador_id,
                        "latitude" => $newOrdenDeServico->gerador ? $newOrdenDeServico->gerador->latitude : null,
                        "longitude" => $newOrdenDeServico->gerador ? $newOrdenDeServico->gerador->longitude : null,
                    ],
                    "destinador" => [
                        "id" => $newOrdenDeServico->destinador_id,
                        "latitude" => $newOrdenDeServico->destinador ? $newOrdenDeServico->destinador->latitude : null,
                        "longitude" => $newOrdenDeServico->destinador ? $newOrdenDeServico->destinador->longitude : null,
                    ]
                ]);

            } catch(Exception $e) {
                echo 'Error Message: ' .$e->getMessage();
            }

            return response([
                'data' => new OrdenDeServicoResource($newOrdenDeServico),
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
