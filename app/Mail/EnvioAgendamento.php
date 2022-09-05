<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnvioAgendamento extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($agenda)
    {
        // $this->codigo = $agenda['codigo'];
        $this->gerador = $agenda['gerador'];
        $this->usuario = $agenda['usuario'];
        $this->celular = $agenda['celular'];
        $this->transportadora = $agenda['transportadora'];
        $this->destinador = $agenda['destinador'];
        $this->acondicionamento = $agenda['acondicionamento'];
        $this->descricao_produto = $agenda['descricao_produto'];
        $this->peso_controle = $agenda['peso_controle'];
        $this->data_inicio_coleta = $agenda['data_inicio_coleta'];
        $this->data_final_coleta = $agenda['data_final_coleta'];
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
                // "codigo" => $this->codigo,
                "gerador" => $this->gerador,
                "usuario" => $this->usuario,
                "celular" => $this->celular,
                "transportadora" => $this->transportadora,
                "destinador" => $this->destinador,
                "acondicionamento" => $this->acondicionamento,  
                "descricao_produto" =>  $this->descricao_produto,
                "peso_controle" => $this->peso_controle,
                "data_inicio_coleta" => $this->data_inicio_coleta,
                "data_final_coleta" => $this->data_inicio_coleta,
                "email" => $this->email,
            ]);
    }
}
