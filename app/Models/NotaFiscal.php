<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class NotaFiscal extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'notas_fiscais';
    protected $fillable = [
        'numero_total',
        'serie',
        'folha',
        'chave_de_acesso',
        'pessoa_juridica_id'

    ];
    protected $guardaded = ['id'];

     public function pessoa_juridica_id()
    {
        return $this->hasOne('App\Models\PessoaJuridica', 'id', 'pessoa_juridica_id');
    }
    public function nota_fiscal_iten()
    {
        return $this->hasOne('App\Models\NotaFiscalIten', 'id', 'nota_fiscal_id');
    }

}
