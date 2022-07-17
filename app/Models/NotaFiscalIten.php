<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class NotaFiscalIten extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'nota_fiscal_itens';
    protected $fillable = [
        'ean',
        'descricao',
        'peso',
        'largura',
        'profundidade',
        'comprimento',
        'quantidade',
        'especie',
        'marca',
        'codigo_do_fabricante ',
        'numero_de_serie',
        'data_de_fabricacao',
        'nota_fiscal_id',
        'unidade_id',
        'usuario_responsavel_cadastro_id'
    ];
    protected $guardaded = ['id'];
    
    public function nota_fiscal()
    {
        return $this->hasOne('App\Models\NotaFiscal', 'id', 'nota_fiscal_id');
    }
    public function unidade()
    {
        return $this->hasOne('App\Models\Unidade', 'id', 'unidade_id');
    }
    public function usuario_responsavel_cadastro()
    {
        return $this->hasOne('App\Models\User', 'usuario_responsavel_cadastro_id', 'id');
    }
}
