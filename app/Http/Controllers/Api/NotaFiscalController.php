<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotaFiscalRequest;
use App\Http\Resources\NotaFiscalResource;
use App\Models\NotaFiscal;
use App\Models\NotaFiscalIten;
use App\Models\Produto;
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
                    $notaFiscalIten = new NotaFiscalIten([
                        'descricao' => $produto_acabado['descricao'],
                        'quantidade' => $produto_acabado['quantidade'],
                        'numero_de_serie' => $produto_acabado['numero_de_serie'],
                        'data_de_fabricacao' => $produto_acabado['data_de_fabricacao'],
                        'nota_fiscal_id' => $nota->id,
                        'usuario_responsavel_cadastro_id' => 1,
                        'item_id' => $produto->id,
                        'item_type' => 'App\Models\Produto',
                    ]);
                    // $notaFiscalIten->item()->save($produto);
                    $notaFiscalIten->save();
                    $nota->nota_fiscal_iten()->create($notaFiscalIten);
                }
            }

            // if ($request->get('produtos_segregados')) {

            // }
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
