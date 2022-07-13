<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $cpf, $name, $email, $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cpf, $name, $email, $password) 
    {
        $this->cpf = $cpf;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('mails.activation')
            ->subject("Notificación de asistencia")
            ->with([
                "cpf" => $this->cpf,
                "name" => $this->name,
                "email" => $this->email,
                "password" => $this->password,
            ]);
    }
}
