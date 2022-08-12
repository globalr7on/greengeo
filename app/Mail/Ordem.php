<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Ordem extends Mailable
{
    use Queueable, SerializesModels;

    public  $tipoA, $tipoB, $tipoC, $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $tipoA, $tipoB, $tipoC, $email)
    {
        
        $this->tipoA = $tipoA;
        $this->tipoB = $tipoB;
        $this->tipoC = $tipoC;
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
                "tipoA" => $this->tipoA,
                "tipoB" => $this->tipoB,
                "tipoC" => $this->tipoC,
                "email" => $this->email,
                
            ]);
    }
}
