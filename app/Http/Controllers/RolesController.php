<?php

namespace App\Http\Controllers;

class RolesController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('roles.index');
    }
}