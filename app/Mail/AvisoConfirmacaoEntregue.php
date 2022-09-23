<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AvisoConfirmacaoEntregue extends Mailable
{
    use Queueable, SerializesModels;
    
    public $confirmar_entregue;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($confirmar_entregue)
    {
        $this->transportadora = $confirmar_entregue['transportadora'];
        $this->email_destinador = $confirmar_entregue['email_destinador'];
        $this->email_transportador = $confirmar_entregue['email_transportador'];
        $this->email_gerador = $confirmar_entregue['email_gerador'];
    }   

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('mails.avisoConfirmacaoEntregue')
            ->subject("Confirmaçã de Entregue")
                ->with([
                    "transportadora" => $this->transportadora,
                    "email_destinador" => $this->email_destinador,
                    "email_transportador" => $this->email_transportador,
                    "email_gerador" => $this->email_gerador,
                ]);
    }
}
