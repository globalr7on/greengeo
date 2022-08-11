<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Ordem extends Mailable
{
    use Queueable, SerializesModels;

    public  $tipo_empresa, $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $tipo_empresa, $email)
    {
        
        $this->tipo_empresa = $tipo_empresa;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $thiss
     */
    public function build()
    {

        return $this
            ->view('mails.ordem')
            ->subject("Nova Ordem de Serviço")
            ->with([
                "tipo_empresa" => $this->tipo_empresa,
                "email" => $this->email,
            ]);
    }
}
