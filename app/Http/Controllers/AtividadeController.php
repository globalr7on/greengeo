<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use Illuminate\Http\Request;

class AtividadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrativo.atividade.index');
    }

}
