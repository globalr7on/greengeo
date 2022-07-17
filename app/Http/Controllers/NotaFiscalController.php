<?php

namespace App\Http\Controllers;

use App\Models\NotaFiscal;
use Illuminate\Http\Request;

class NotaFiscalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $xmlDataString = file_get_contents(public_path('xmlfile/nota.xml'));
        $xmlObject = simplexml_load_string($xmlDataString);      
        $json = json_encode($xmlObject);
        $phpDataArray = json_decode($json, true); 
        // dd($phpDataArray["infNFe"]);//["ide"]);
      
        $nota = $phpDataArray["infNFe"]["ide"]["cNF"];
        $serie = $phpDataArray["infNFe"]["ide"]["serie"];
        $emicao = $phpDataArray["infNFe"]["ide"]["dhEmi"];
        $saida = $phpDataArray["infNFe"]["ide"]["dhSaiEnt"];
        $cnpj = $phpDataArray["infNFe"]["emit"]["CNPJ"];
        $nome = $phpDataArray["infNFe"]["emit"]["xNome"];
        $empresa = $phpDataArray["infNFe"]["emit"]["xFant"];
        $endereco = $phpDataArray["infNFe"]["emit"]["enderEmit"]["xLgr"];
        $numero = $phpDataArray["infNFe"]["emit"]["enderEmit"]["nro"];
        $cep = $phpDataArray["infNFe"]["emit"]["enderEmit"]["CEP"];
        $fone = $phpDataArray["infNFe"]["emit"]["enderEmit"]["fone"];
        $ean = $phpDataArray["infNFe"]["det"]["prod"]["cEAN"];
        $produto = $phpDataArray["infNFe"]["det"]["prod"]["xProd"];
        
        // $serie = $phpDataArray["infNFe"]["ide"]["serie"];
        // $serie = $phpDataArray["infNFe"]["ide"]["serie"];


        // dd($nota, $serie, $emisao, $saida, $cnpj, $nome, $empresa, $endereco, $numero, $cep, $fone, $produto,$ean);
        // return view('rastreamento.notaFiscal', compact('nota','serie','emicao','saida', 'cnpj'));
        return view('rastreamento.nota.index', compact('nota','serie','emicao','saida', 'cnpj'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NotaFiscal  $notaFiscal
     * @return \Illuminate\Http\Response
     */
    public function show(NotaFiscal $notaFiscal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NotaFiscal  $notaFiscal
     * @return \Illuminate\Http\Response
     */
    public function edit(NotaFiscal $notaFiscal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NotaFiscal  $notaFiscal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotaFiscal $notaFiscal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotaFiscal  $notaFiscal
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotaFiscal $notaFiscal)
    {
        //
    }
}
