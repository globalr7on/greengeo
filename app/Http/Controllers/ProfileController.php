<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    /**
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('profile.index');
    }
}
