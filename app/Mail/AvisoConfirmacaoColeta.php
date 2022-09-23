<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AvisoConfirmacaoColeta extends Mailable
{
    use Queueable, SerializesModels;

    public $confirmar_coleta;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($confirmar_coleta)
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
            ->view('mails.avisoConfirmacaoColeta')
            ->subject("Confirmação de Aceite de pedido de Coleta")
                ->with([
                    "transportadora" => $this->transportadora,
                    "email" => $this->email,
                ]);
    }
}
