<?php

namespace App\Http\Controllers;

use App\Models\Rastreamento;
use Illuminate\Http\Request;

class RastreamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rastreamento.rastreamento');
    }

}
