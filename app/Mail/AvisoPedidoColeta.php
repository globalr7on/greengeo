<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AvisoPedidoColeta extends Mailable
{
    use Queueable, SerializesModels;

    public $pedido_coleta;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pedido_coleta)
    {
        $this->transportadora = $pedido_coleta['transportadora'];
        $this->email = $pedido_coleta['email'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('mails.avisoPedidoColeta')
            ->subject("Confirmação de pedido de Coleta")
                ->with([
                    "transportadora" => $this->transportadora,
                    "email" => $this->email,
                ]);
    }
}
