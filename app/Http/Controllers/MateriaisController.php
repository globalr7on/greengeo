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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materiais  $materiais
     * @return \Illuminate\Http\Response
     */
    public function show(Materiais $materiais)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materiais  $materiais
     * @return \Illuminate\Http\Response
     */
    public function edit(Materiais $materiais)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materiais  $materiais
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materiais $materiais)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materiais  $materiais
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materiais $materiais)
    {
        //
    }
}
