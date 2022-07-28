<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotaFiscalRequest;
use App\Http\Resources\NotaFiscalResource;
use App\Models\NotaFiscal;
use App\Models\NotaFiscalIten;
use App\Models\Produto;
use App\Models\ProdutoSegregados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return response([
            'data' => NotaFiscalResource::collection($nota),
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
        DB::beginTransaction();
        try {
            $nota = NotaFiscal::create($request->except('produtos_acabados', 'produtos_segregados'));
            if ($request->get('produtos_acabados')) {
                foreach ($request->get('produtos_acabados') as $produto_acabado) {
                    $produto = Produto::find($produto_acabado['producto_id']);
                    $produto->nota_fiscal_iten()->create([
                        'quantidade' => $produto_acabado['quantidade'],
                        'numero_de_serie' => $produto_acabado['numero_de_serie'],
                        'data_de_fabricacao' => $produto_acabado['data_de_fabricacao'],
                        'nota_fiscal_id' => $nota->id,
                        'usuario_responsavel_cadastro_id' => $produto_acabado['usuario_responsavel_cadastro_id']
                    ]);
                }
            }

            if ($request->get('produtos_segregados')) {
                foreach ($request->get('produtos_segregados') as $produto_segregado) {
                    $segregado = ProdutoSegregados::create($produto_segregado);
                    $segregado->nota_fiscal_iten()->create([
                        'quantidade' => 1,
                        'numero_de_serie' => null,
                        'data_de_fabricacao' => null,
                        'nota_fiscal_id' => $nota->id,
                        'usuario_responsavel_cadastro_id' => $produto_segregado['usuario_responsavel_cadastro_id']
                    ]);
                }
            }

            DB::commit();

            return response([
                'data' => new NotaFiscalResource($nota),
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
        DB::beginTransaction();
        try {
            $nota = NotaFiscal::find($id);
            $nota->update($request->except('produtos_acabados', 'produtos_segregados'));
            if ($request->get('produtos_acabados')) {
                $produtoClass = get_class(Produto::getModel());
                $produtoIds = array_column($request->get('produtos_acabados'), 'id');
                $produtoToDelete = $nota->nota_fiscal_itens->where('itenable_type', $produtoClass)->whereNotIn('id', $produtoIds);
                if (count($produtoToDelete->all()) > 0) {
                    $produtoToDelete->each->delete();
                }
                foreach ($request->get('produtos_acabados') as $produto_acabado) {
                    $produto = Produto::find($produto_acabado['producto_id']);
                    $produto->nota_fiscal_iten()->updateOrCreate([
                        'id' => $produto_acabado['id']
                    ], [
                        'quantidade' => $produto_acabado['quantidade'],
                        'numero_de_serie' => $produto_acabado['numero_de_serie'],
                        'data_de_fabricacao' => $produto_acabado['data_de_fabricacao'],
                        'nota_fiscal_id' => $nota->id,
                        'usuario_responsavel_cadastro_id' => $produto_acabado['usuario_responsavel_cadastro_id']
                    ]);
                }
            }

            if ($request->get('produtos_segregados')) {
                $segregadoClass = get_class(ProdutoSegregados::getModel());
                $segregadoIds = array_column($request->get('produtos_segregados'), 'parentId');
                $segregadoToDelete = $nota->nota_fiscal_itens->where('itenable_type', $segregadoClass)->whereNotIn('id', $segregadoIds);
                if (count($segregadoToDelete->all()) > 0) {
                    $segregadoToDelete->each->delete();
                    ProdutoSegregados::whereIn('id', $segregadoToDelete->pluck('itenable_id')->all())->delete();
                }
                foreach ($request->get('produtos_segregados') as $produto_segregado) {
                    $segregado = ProdutoSegregados::updateOrCreate(['id' => $produto_segregado['id']], $produto_segregado);
                    $segregado->nota_fiscal_iten()->updateOrCreate([
                        'id' => $produto_segregado['parentId']
                    ], [
                        'quantidade' => 1,
                        'numero_de_serie' => null,
                        'data_de_fabricacao' => null,
                        'nota_fiscal_id' => $nota->id,
                        'usuario_responsavel_cadastro_id' => $produto_segregado['usuario_responsavel_cadastro_id']
                    ]);
                }
            }

            DB::commit();

            return response([
                'data' => new NotaFiscalResource($nota),
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
        NotaFiscal::findOrFail($id)->delete();
        return response(null, 204);
    }
}
