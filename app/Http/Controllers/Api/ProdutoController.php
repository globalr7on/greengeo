<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoRequest;
use App\Http\Resources\ProdutoResource;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = auth()->user();
        if ($currentUser->hasRole('admin')) {
            $produto = Produto::all();
        } else {
            $produto = Produto::where('pessoa_juridica_id', $currentUser->pessoa_juridica_id);
        }
        return response([
            'data' => ProdutoResource::collection($produto),
            'status' => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProdutoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        DB::beginTransaction();
        try {
            $produto = Produto::create($request->except('materiais'));
            $produto->materiais()->attach($request->get('materiais'));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response([
                'data' => $e->getMessage(),
                'status' => false
            ], 400);
        }

        return response([
            'data' => new ProdutoResource($produto),
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
            'data' => new ProdutoResource(Produto::find($id)),
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
        DB::beginTransaction();
        try {
            $produto = Produto::find($id);
            $produto->update($request->except('materiais'));
            $produto->materiais()->sync($request->get('materiais'));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response([
                'data' => $e->getMessage(),
                'status' => false
            ], 400);
        }

        return response([
            'data' => new ProdutoResource($produto),
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
        DB::beginTransaction();
        try {
            $produto = Produto::findOrFail($id);
            $produto->materiais()->detach();
            $produto->delete();
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
     * Update status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $status = false;
        $produto = Produto::find($id);
        if ($request->has('ativo') && in_array($request->ativo, [1, 0])) {
            $produto->update($request->all());
            $status = true;
        }

        return response([
            'status' => $status
        ], 200);
    }
}
