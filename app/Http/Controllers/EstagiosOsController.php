<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstagiosOsController extends Controller
{
    public function index(Request $request)
    {
        return view('estagio.index');
    }
}
