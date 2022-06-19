<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        return view('users.index');
    }
}
