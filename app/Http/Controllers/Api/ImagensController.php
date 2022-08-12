<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImagenRequest;
use App\Http\Resources\ImagenResource;
use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ImagensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imagens = Imagen::all();
        return response([
            'data' => ImagenResource::collection($imagens),
            'status' => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImagenRequest $request)
    {
        DB::beginTransaction();
        $imagesStorage = [];
        try {
            $imagesCollection = collect();
            $orden_servicio_id = $request->get('orden_servicio_id');
            foreach ($request->file('imagens') as $image) {
                $tempName = time().rand().'.'.$image->extension();
                $imageName = Storage::disk('do')->putFileAs('uploads', $image, $tempName, 'public');
                array_push($imagesStorage, $imageName);
                $imagen = Imagen::create([
                    'url' => $imageName,
                    'orden_servico_id' => $orden_servicio_id,
                ]);
                $imagesCollection->add($imagen);
            }
            DB::commit();

            return response([
                'data' => ImagenResource::collection($imagesCollection),
                'status' => true
            ], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            foreach ($imagesStorage as $image) {
                Storage::disk('do')->delete($image);
            }

            return response([
                'data' => "Ocorreu um problema ao salvar, tente novamente",
                'status' => false
            ], 400);
        } catch (\Exception $e) {
            DB::rollBack();
            foreach ($imagesStorage as $image) {
                Storage::disk('do')->delete($image);
            }

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
            'data' => new ImagenResource(Imagen::find($id)),
            'status' => true
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagen = Imagen::findOrFail($id);
        Storage::disk('do')->delete($imagen->url);
        $imagen->delete();
        
        return response(null, 204);
    }
}
