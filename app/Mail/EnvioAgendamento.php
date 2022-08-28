<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnvioAgendamento extends Mailable
{
    use Queueable, SerializesModels;

    public $codigo, $transportadora, $acondicionamento, $descricao_produto , $peso_total_os, $data_coleta;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($codigo, $transportadora, $acondicionamento, $descricao_produto, $peso_total_os, $data_coleta)
    {
        $this->codigo = $codigo;
        $this->tranposrtadora = $transportadora;
        $this->acondicionamento = $acondicionamento;
        $this->descricao_produto = $descricao_produto;
        $this->peso_total_os = $peso_total_os;
        $this->data_coleta = $data_coleta;
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
                "transportadora" => $this->transportadora,
                "acondicionamento" => $this->acondicionamento,
                "descricao_produto" =>  $this->descricao_produto,
                "peso_total_os" => $this->peso_total_os,
                "data_coleta" => $this->data_coleta,
            ]);
    }
}
