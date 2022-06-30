<?php

namespace App\Http\Controllers;

use App\Models\Acondicionamento;
use Illuminate\Http\Request;

class AcondicionamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('administrativo.acondicionamento');
        return view('acondicionamento.index');
    }

}
