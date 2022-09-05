<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\OrdenDeServicoRequest;
use App\Http\Requests\OrdenDeServicoAprovacaoRequest;
use App\Http\Requests\UploadMTRorCDFRequest;
use App\Http\Resources\OrdenDeServicoResource;
use App\Models\OrdensServicos;
use App\Models\PessoaJuridica;
use App\Models\OrdenServicoMotorista;
use App\Models\Produto;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\Mail\Ordem;
use Mail;
use App\Traits\OrdenServicoTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

const TIMEZONE_BRAZIL = 'America/Sao_Paulo';

class OrdenDeServicoController extends Controller
{
    use OrdenServicoTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentUser = auth()->user();
        if ($currentUser->hasRole('admin')) {
            $ordenServico = OrdensServicos::all();
        } else {
            if ($currentUser->hasRole('motorista')) {
                $ordenServico = OrdensServicos::where('motorista_id', $currentUser->id)->get();
            } else {
                $currentEmpresaId = $currentUser->pessoa_juridica_id;
                $currentTipoEmpresa = $currentUser->pessoa_juridica && $currentUser->pessoa_juridica->tipo_empresa ?  $currentUser->pessoa_juridica->tipo_empresa->descricao : null;
                if ($currentTipoEmpresa == 'Gerador') {
                    $ordenServico = OrdensServicos::where('gerador_id', $currentEmpresaId)->get();
                } elseif ($currentTipoEmpresa == 'Destinador') {
                    $ordenServico = OrdensServicos::where('destinador_id', $currentEmpresaId)->get();
                } elseif ($currentTipoEmpresa == 'Transportador') {
                    $ordenServico = OrdensServicos::where('transportador_id', $currentEmpresaId)->get();
                } elseif ($currentTipoEmpresa == 'GDT') {
                    $ordenServico = OrdensServicos::where('gerador_id', $currentEmpresaId)->orWhere('destinador_id', $current_empresa)->orWhere('transportador_id',  $current_empresa)->get();
                }
            }
        }

        if ($request->has('estagio_id')) {
            $estagios = str_contains($request->estagio_id, ',') ? explode(',', $request->estagio_id) : [$request->estagio_id];
            $ordenServico = $ordenServico->whereIn('estagio_id', $estagios);
        }

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
        DB::beginTransaction();
        try {
            // $request->merge(array('codigo' => $this->generateCode(OrdensServicos::class)));
            $request->merge([
                'estagio_id' => 1,
                'data_inicio_coleta' => new Carbon(new Carbon($request->get('data_inicio_coleta'), TIMEZONE_BRAZIL), 'UTC'),
                'data_final_coleta' => new Carbon(new Carbon($request->get('data_final_coleta'), TIMEZONE_BRAZIL), 'UTC')
            ]);
            $newOrdemServico = OrdensServicos::create($request->except(['produtos']));
            if ($request->get('produtos')) {
                foreach ($request->get('produtos') as $produto) {
                    $produtoAcabado = Produto::create([
                        'codigo' => $produto['codigo'],
                        'descricao' => $produto['descricao'],
                        'unidade_id' => $produto['unidade_id'],
                        'pessoa_juridica_id' => $produto['pessoa_juridica_id'],
                        'ativo' => 2
                    ]);
                    $newOrdemServico->itens()->create([
                        'produto_id' => $produtoAcabado->id,
                        'peso' => $produto['peso'],
                        'quantidade' => $produto['quantidade'],
                    ]);
                }
            }

            $agenda = [
                // 'codigo'  => $agendamento->ordem_servico->codigo,
                'gerador' => $newOrdemServico->gerador->nome_fantasia,
                'usuario' => $newOrdemServico->responsavel->name,
                'celular' => $newOrdemServico->responsavel->celular,
                'descricao_produto' => $newOrdemServico->description,
                'peso_controle' => $newOrdemServico->peso_controle,
                'transportadora' => $newOrdemServico->transportador->nome_fantasia,
                'destinador' => $newOrdemServico->destinador->nome_fantasia,
                'acondicionamento' => $newOrdemServico->acondicionamento->descricao,
                'email' => $newOrdemServico->transportador->email,
                'data_inicio_coleta' => (new Carbon(new Carbon($newOrdemServico->data_inicio_coleta, 'UTC'), TIMEZONE_BRAZIL))->format('Y-m-d H:i:s'),
                'data_final_coleta' => (new Carbon(new Carbon($newOrdemServico->data_final_coleta, 'UTC'), TIMEZONE_BRAZIL))->format('Y-m-d H:i:s'),
            ];
            Mail::to($agenda['email'])->send(new EnvioAgendamento($agenda));

            DB::commit();
            return response([
                'data' => new OrdenDeServicoResource($newOrdemServico),
                'status' => true
            ], 200);
        } catch(\Exception $error) {
            DB::rollBack();
            return response([
                'data' => $error->getMessage(),
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
        DB::beginTransaction();
        try {
            $ordenServico = OrdensServicos::find($id);
            $ordenServico->update($request->except('produtos'));
            // if ($ordenServico->motorista_id) {
            //     OrdenServicoMotorista::create([
            //         'usuario_id' => $ordenServico->motorista_id,
            //         'ordem_servico_id' => $ordenServico->id
            //     ]);
            //     $ordenServico->estagio_id = $this->getNextEstagio($ordenServico->estagio_id);
            //     $ordenServico->save();
            // }
            if ($request->get('produtos')) {
                $itensIds = array_column($request->get('produtos'), 'id');
                $itensToDelete = $ordenServico->itens->whereNotIn('id', $itensIds);
                if (count($itensToDelete->all()) > 0) {
                    $produtoIds = $itensToDelete->pluck('produto_id');
                    $itensToDelete->each->delete();
                    Produto::whereIn('id', $produtoIds)->delete();
                }
                foreach ($request->get('produtos') as $produto) {
                    $produtoAcabado = Produto::updateOrCreate([
                        'id' => $produto['produto_id']
                    ], [
                        'codigo' => $produto['codigo'],
                        'descricao' => $produto['descricao'],
                        'unidade_id' => $produto['unidade_id'],
                        'pessoa_juridica_id' => $produto['pessoa_juridica_id'],
                        'ativo' => 2
                    ]);
                    $ordenServico->itens()->updateOrCreate([
                        'id' => $produto['id']
                    ], [
                        'produto_id' => $produtoAcabado->id,
                        'peso' => $produto['peso'],
                        'quantidade' => $produto['quantidade'],
                    ]);
                }
            }
            DB::commit();
    
            return response([
                'data' => new OrdenDeServicoResource($ordenServico),
                'status' => true
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response([
                'data' => $e->getMessage(),
                'status' => false
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $ordenServico = OrdensServicos::findOrFail($id);
            $ordenServico->itens()->delete();
            $ordenServico->imagens()->delete();
            $ordenServico->notas_fiscais()->detach();
            $ordenServico->aprovacao_motorista()->delete();
            $ordenServico->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response([
                'data' => $e->getMessage(),
                'status' => false
            ], 400);
        }
        return response(null, 204);
    }

    /**
     * Update the estagio
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateEstagio(Request $request, $id)
    {
        try {
            $ordenServico = OrdensServicos::find($id);
            $ordenServico->update(["estagio_id" => $this->getNextEstagio($ordenServico->estagio_id)]);
            return response([
                'data' => new OrdenDeServicoResource($ordenServico),
                'status' => true
            ], 200);
        } catch (\Exception $error) {
            return response([
                'data' => $error->getMessage(),
                'status' => false
            ], 400);
        }
    }

    /**
     * Approval/Reject OS by motorista
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  boolean  $aceitar
     * @return \Illuminate\Http\Response
     */
    public function aprovacaoMotorista(OrdenDeServicoAprovacaoRequest $request, $id)
    {
        try {
            $status = true;
            $ordenServico = OrdensServicos::find($id);
            $aprovacaoMotorista = $ordenServico->aprovacao_motorista->filter(function ($data) {
                return $data->status === null;
            })->first();

            if (!$aprovacaoMotorista) {
                $status = false;
            } else {
                $aprovacao = $request->get('status', null);
                $aprovacaoMotorista->status = $aprovacao;
                $aprovacaoMotorista->observacao = $aprovacao ? null : $request->get('observacao', null);
                $aprovacaoMotorista->save();
                $newEstagio = $aprovacao ? $this->getNextEstagio($ordenServico->estagio_id) : $this->getPrevEstagio($ordenServico->estagio_id);
                $motorista = $aprovacao ? $ordenServico->motorista_id : null;
                $ordenServico->update(["estagio_id" => $newEstagio, "motorista_id" => $motorista]);
            }

            return response([
                'data' => new OrdenDeServicoResource($ordenServico),
                'status' => $status
            ], 200);
        } catch (\Exception $error) {
            return response([
                'data' => $error->getMessage(),
                'status' => false
            ], 400);
        }
    }

    public function uploadMTR(UploadMTRorCDFRequest $request, $id){
        DB::beginTransaction();
        $fileName = null;
        try {
            $pdf = $request->file('pdf');
            $tempName = time().rand().'.'.$pdf->extension();
            $fileName = Storage::disk('do')->putFileAs('mtr', $pdf, $tempName, 'public');
            $ordenServico = OrdensServicos::find($id);
            $ordenServico->update(['mtr_link' => $fileName]);
            DB::commit();

            return response([
                'data' => new OrdenDeServicoResource($ordenServico),
                'status' => true
            ], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Storage::disk('do')->delete($fileName);

            return response([
                'data' => "Ocorreu um problema ao salvar, tente novamente",
                'status' => false
            ], 400);
        } catch (\Exception $e) {
            DB::rollBack();
            Storage::disk('do')->delete($fileName);

            return response([
                'data' => $e->getMessage(),
                'status' => false
            ], 400);
        }
    }

    public function uploadCDF(UploadMTRorCDFRequest $request, $id){
        DB::beginTransaction();
        $fileName = null;
        try {
            $pdf = $request->file('pdf');
            $tempName = time().rand().'.'.$pdf->extension();
            $fileName = Storage::disk('do')->putFileAs('cdf', $pdf, $tempName, 'public');
            $ordenServico = OrdensServicos::find($id);
            $ordenServico->update(['cdf_link' => $fileName]);
            DB::commit();

            return response([
                'data' => new OrdenDeServicoResource($ordenServico),
                'status' => true
            ], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Storage::disk('do')->delete($fileName);

            return response([
                'data' => "Ocorreu um problema ao salvar, tente novamente",
                'status' => false
            ], 400);
        } catch (\Exception $e) {
            DB::rollBack();
            Storage::disk('do')->delete($fileName);

            return response([
                'data' => $e->getMessage(),
                'status' => false
            ], 400);
        }
    }
}
