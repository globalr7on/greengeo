<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Produto extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'produto_acabado';
    protected $fillable = [
        'nome_fabricante',
        'peso_bruto',
        'peso_liquido',
        'dimensoes',
        'altura',
        'largura',
        'profundidade',
        'comprimento',
        'especie',
        'marca',
        'pessoa_juridica_id',
        'material_id',
        'ativo',
    ];
    protected $guardaded = ['id'];

    // public function usuario_responsavel_cadastro()
    // {
    //     return $this->hasOne('App\Models\User', 'usuario_responsavel_cadastro_id', 'id');
    // }

    // public function tipo_empresa()
    // {
    //     return $this->hasOne('App\Models\TipoEmpresa');
    // }

    // public function user()
    // {
    //     return $this->belongsTo('App\Models\User', 'usuario_responsavel_cadastro_id', 'id');
    // }

    // public function veiculo()
    // {
    //     return $this->belongsTo('App\Models\Veiculo');
    // }

     
}