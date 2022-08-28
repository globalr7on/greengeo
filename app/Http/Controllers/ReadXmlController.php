<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReadXmlController extends Controller
{
    public function index()
    {
        $xmlDataString = file_get_contents(public_path('/assets/xmlfile/41220705102155000152550010000844001004480014-nfe.XML'));
        $xmlObject = simplexml_load_string($xmlDataString);
        $json = json_encode($xmlObject);
        $phpDataArray = json_decode($json, true); 
        dd($phpDataArray);
        $nota = $phpDataArray['NFe']['infNFe']['ide']['natOp'];
        $produto = $phpDataArray['NFe']['infNFe']['det']['prod'];
        // dd($nota,$produto);
        $descricao = $phpDataArray['NFe']['infNFe']['ide']['natOp'];
        $chave = $phpDataArray['NFe']['infNFe']['ide']['cNF'];
        $numero_df = $phpDataArray['NFe']['infNFe']['ide']['nNF'];
        $serie = $phpDataArray['NFe']['infNFe']['ide']['serie'];
        $emisao = $phpDataArray['NFe']['infNFe']['ide']['dhEmi'];
        $saida = $phpDataArray['NFe']['infNFe']['ide']['dhSaiEnt'];
        
        dd($descricao, $chave, $numero_df, $serie, $emisao, $saida);
        return view('rastreamento.nota.xml');
    }
}
