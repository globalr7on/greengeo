<?php

namespace App\Http\Controllers;

use App\Models\Tratamento;
use Illuminate\Http\Request;

class TratamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrativo.tratamento.index');
    }

}
