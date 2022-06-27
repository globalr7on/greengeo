<?php

namespace App\Http\Controllers;

use App\Models\TipoMaterial;
use Illuminate\Http\Request;

class TipoEmpresaController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrativo.tipoEmpresa.index');
    }

}
