<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
// use App\Http\Requests\ImagensRequest;
// use App\Http\Resources\ImagensResource;
use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Imagen $imagen)
    {

        //   $files = $request->file('uploaded_file');
        //   dd($files);

        $extension = $request->file('uploaded_file')->extension();
        $mimeType =  $request->file('uploaded_file')->getMimeType();
        $file = Storage::disk('do')->putFileAs('uploads', $request->file('uploaded_file'), time().'.'.$extension, 'public');
        $nome_arquivo = $request->file('uploaded_file');
        $path ="https://greenbeat-images.nyc3.digitaloceanspaces.com/".$file."";
        

        // $files = $request->file('uploaded_file');

        // foreach($files as $file){
        //     $this->Image::create([
        //         'url' => $request->title,
        //         'product_id' => base64_decode($request->product_id),
        //         'image' => $upload->upload_global($file, 'productimage'),
        //         'create_uid' => Auth::user()->id,
        //         'write_uid' => Auth::user()->id
        //     ]);
        // }


        $ima = new Imagen;
        $ima->url = $path;
        $ima->nome_arquivo = $nome_arquivo;
        $ima->orden_servico_iten_id = NULL;
        $ima->save();
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
