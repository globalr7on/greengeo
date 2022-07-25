<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagensController extends Controller
{
    public function index()
    {
        return view('rastreamento.os.modalFotos');
    }
     
}
