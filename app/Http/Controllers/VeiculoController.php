<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('cadastros.veiculo');
        return view('cadastros.veiculo.index');
    }

}
