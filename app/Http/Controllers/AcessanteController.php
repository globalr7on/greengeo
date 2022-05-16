<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAcessanteRequest;
use App\Http\Resources\AcessanteResource;
use App\Models\Acessante;
use App\Models\User;
use Illuminate\Http\Request;

class AcessanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = Acessante::find(1)->name;
        dd($name);
        return view('cadastros.acessante');
       
    }
}
