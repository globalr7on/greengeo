<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnvioAgendamento extends Mailable
{
    use Queueable, SerializesModels;

    public $codigo, $gerador, $usuario_gerador, $telefono_gerador, $transportadora, $acondicionamento, $descricao_produto , $peso_total, $data_coleta;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($codigo, $gerador, $usuario_gerador, $telefono_gerador, $transportadora, $acondicionamento, $descricao_produto, $peso_total, $data_coleta)
    {
        $this->codigo = $codigo;
        $this->gerador = $gerador;
        $this->$usuario_gerador = $usuario_gerador;
        $this->$telefono_gerador = $telefono_gerador;
        $this->transportadora = $transportadora;
        $this->acondicionamento = $acondicionamento;
        $this->descricao_produto = $descricao_produto;
        $this->peso_total = $peso_total;
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
                "gerador" => $this->gerador,
                "usuario_gerador" => $this->usuario_gerador,
                "telefono_gerador" => $this->telefono_gerador,
                "transportadora" => $this->transportadora,
                "acondicionamento" => $this->acondicionamento,
                "descricao_produto" =>  $this->descricao_produto,
                "peso_total" => $this->peso_total,
                "data_coleta" => $this->data_coleta,
            ]);
    }
}
