<?php

namespace App\Http\Controllers\Auth;

use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
  
    * Write code on Method
    *
    * @param  \Illuminate\Http\Request  $request
    * @return response()
    */
    public function login(Request $request)
    {
        $request->validate([
            'cpf' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('cpf', 'password');
        if (Auth::attempt($credentials)) {

            return redirect()->route('home');
        } else {
            return back()->withErrors(['password' => 'CPF/Password incorrecta']);
        }

        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
}
