<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdemDeServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('rastreamento.os.index');
    }
}
