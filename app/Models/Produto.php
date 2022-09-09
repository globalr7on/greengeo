<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Produto extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'produto_acabado';
    protected $fillable = [
        'codigo',
        'descricao',
        'ean',
        'altura',
        'largura',
        'profundidade',
        'comprimento',
        'especie',
        'marca',
        'pessoa_juridica_id',
        'unidade_id',
        'numero_serie',
        'data_fabricacao',
        'ativo',
    ];
    protected $guardaded = ['id'];

    public function materiais()
    {
        return $this->belongsToMany('App\Models\Material', 'material_produto')->withPivot('peso_bruto', 'peso_liquido', 'percentual_composicao');
    }

    public function pessoa_juridica()
    {
        return $this->hasOne('App\Models\PessoaJuridica', 'id', 'pessoa_juridica_id');
    }

    public function unidade()
    {
        return $this->hasOne('App\Models\Unidade', 'id', 'unidade_id');
    }

    public function nota_fiscal_iten()
    {
        return $this->morphOne('App\Models\NotaFiscalIten', 'itenable');
    }
}