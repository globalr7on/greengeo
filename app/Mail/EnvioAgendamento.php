<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnvioAgendamento extends Mailable
{
    use Queueable, SerializesModels;

    // public $codigo, $gerador, $usuario_gerador, $telefono_gerador, $transportadora, $acondicionamento, $descricao_produto , $peso_total, $data_coleta;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($agenda)
    {
        $this->codigo = $agenda['codigo'];
        $this->gerador = $agenda['gerador'];
        $this->usuario = $agenda['usuario'];
        $this->celular = $agenda['celular'];
        $this->transportadora = $agenda['transportadora'];
        $this->acondicionamento = $agenda['acondicionamento'];
        $this->descricao_produto = $agenda['descricao_produto'];
        $this->peso_total = $agenda['peso_total'];
        $this->data_coleta = $agenda['data_coleta'];
        $this->email = $agenda['email'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('mails.agendamento')
            ->subject("Solicitud de Coleta")
            ->with([
                "codigo" => $this->codigo,
                "gerador" => $this->gerador,
                "usuario" => $this->usuario,
                "celular" => $this->celular,
                "transportadora" => $this->transportadora,
                "acondicionamento" => $this->acondicionamento,  
                "descricao_produto" =>  $this->descricao_produto,
                "peso_total" => $this->peso_total,
                "data_coleta" => $this->data_coleta,
                "email" => $this->email,
            ]);
    }
}
