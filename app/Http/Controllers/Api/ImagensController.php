<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
// use App\Http\Requests\ImagensRequest;
// use App\Http\Resources\ImagensResource;
use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

const DO_S3_PATH = "https://greenbeat-images.nyc3.digitaloceanspaces.com/";

class ImagensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $imagen = Imagen::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $orden_servicio_id = $request->get('orden_servicio_id');
            foreach ($request->file('uploaded_file') as $image) {
                $tempName = time().'.'.$image->extension();
                $imageName = Storage::disk('do')->putFileAs('uploads', $image, $tempName, 'public');
                $imageUrl = DO_S3_PATH.$imageName;

                $ima = new Imagen;
                $ima->url = $imageUrl;
                $ima->nome_arquivo = $image->getClientOriginalName();
                // $ima->orden_servico_iten_id = $orden_servicio_id;
                $ima->orden_servico_iten_id = null;
                $ima->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response([
                'data' => $e->getMessage(),
                'status' => false
            ], 400);
        }

        return back()->with('success_message', 'Carregar com sucesso');
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
        //
    }
}
