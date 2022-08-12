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
use App\Mail\Ordem;
// use Validator;
// use Hash;
use Mail;
// use Str;

class OrdenDeServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentUser = auth()->user();
        // dd($currentUser->pessoa_juridica_id);
        if ($currentUser->hasRole('admin')) {
            $ordenServico = OrdensServicos::all();
        }else {
            if ($currentUser->hasRole('motorista')) {
                $ordenServico = OrdensServicos::where('motorista_id', $currentUser->id)->get();
            } else {
                $currentEmpresaId = $currentUser->pessoa_juridica_id;
                // dd($currentEmpresaId);
                $currentTipoEmpresa = $currentUser->pessoa_juridica && $currentUser->pessoa_juridica->tipo_empresa ?  $currentUser->pessoa_juridica->tipo_empresa->descricao : null;
                if ($currentTipoEmpresa == 'Gerador') {
                    $ordenServico = OrdensServicos::where('gerador_id', $currentEmpresaId)->get();
                } elseif ($currentTipoEmpresa == 'Destinador') {
                    $ordenServico = OrdensServicos::where('destinador_id', $currentEmpresaId)->get();
                } elseif ($currentTipoEmpresa == 'Transportador') {
                    $ordenServico = OrdensServicos::where('transportador_id', $currentEmpresaId)->get();
                } elseif ($currentTipoEmpresa == 'GDT') {
                    $ordenServico = OrdensServicos::where('gerador_id', $currentEmpresaId)
                                            ->orWhere('destinador_id', $current_empresa)
                                            ->orWhere('transportador_id',  $current_empresa)
                                            ->get();
                }
            }
        }

        // event(new Registered($user));
        return response([
            'data' =>OrdenDeServicoResource::collection($ordenServico),
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
            // dd($newOrdenDeServico->destinador, $newOrdenDeServico->motorista );
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

            $tipoA = $newOrdenDeServico->gerador->nome_fantasia;
            $tipoB = $newOrdenDeServico->destinador->nome_fantasia;
            $tipoC = $newOrdenDeServico->transportador->nome_fantasia;
            $email = $newOrdenDeServico->destinador->email;
            // dd($ordenServico);
            Mail::to($email)->send(new Ordem($tipoA, $tipoB, $tipoC, $email));

            // Mail::to($newOrdenDeServico->motorista->email)->send(new Ordem($tipoA, $tipoB));
            

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
        $ordenServico = OrdensServicos::find($id);
        $ordenServico->update($request->all());
        return response([
            'data' => new OrdenDeServicoResource($ordenServico),
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
