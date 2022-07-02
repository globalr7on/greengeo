<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PessoaJuridicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('cadastros.empresa.index');
    }

    // /**
    //  * Store a new user.
    //  *
    //  * @param  Request  $request
    //  * @return Response
    //  */
    // public function store(Request $request)
    // {
    //      $cep = $request->input('input_cep');
    //      dd($cep);
    // }


}
