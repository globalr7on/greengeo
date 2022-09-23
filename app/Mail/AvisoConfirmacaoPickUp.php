<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AvisoConfirmacaoPickUp extends Mailable
{
    use Queueable, SerializesModels;
    
    public $confirmar_pickup;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($confirmar_pickup)
    {
        $this->transportadora = $confirmar_coleta['transportadora'];
        $this->email = $confirmar_coleta['email'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('mails.avisoConfirmacaoPickUp')
            ->subject("Confirmação Confirmação de pick-up")
                ->with([
                    "transportadora" => $this->transportadora,
                    "email" => $this->email,
                ]);
    }
}
