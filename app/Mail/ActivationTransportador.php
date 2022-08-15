<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationTransportador extends Mailable
{
    use Queueable, SerializesModels;

    public $cpf, $name, $email, $password, $tipo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cpf, $name, $email, $password, $tipo) 
    {
        $this->cpf = $cpf;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->tipo = $tipo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('mails.activationTransportador')
            ->subject("Notificação de novo acesso")
            ->with([
                "cpf" => $this->cpf,
                "name" => $this->name,
                "email" => $this->email,
                "password" => $this->password,
                "tipo" => $this->tipo,

            ]);
    }
}
