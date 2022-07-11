<?php

namespace App\Http\Controllers;

use App\Models\Materiais;
use Illuminate\Http\Request;

class MateriaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cadastros.material.index');
    }
}
