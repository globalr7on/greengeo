<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\UserController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $token = $request->session()->get('token', function () {
            $userController = new UserController();
            return $userController->accessToken(new Request(), Auth::user());
        });
        $request->session()->put('token', $token);

        $tipo_empresa=Auth::user()->pessoa_juridica->tipo_empresa->descricao;
        // dd($tipo_empresa);
        return view('dashboard' , compact('tipo_empresa'));
    }
}
