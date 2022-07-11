<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ActivationReceived;
use Mail;

class EmailController extends Controller
{
    public function contact(Request $request){
        
        $email = User::pluck('email');
        
        $password = User::pluck('password');
        // dd($password);
        $mailable = new ActivationReceived($email, $password);
        Mail::to($email)->send(new ActivationReceived($email, $password));
        
    }
}
