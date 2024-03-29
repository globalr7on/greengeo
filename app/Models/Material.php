<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Material extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'materiais';
    protected $fillable = [
        'ibama_id',
        'estado_fisico',
        'gerador_id',
        'tipo_material_id',
        'unidade_id',
        'ativo',
    ];

    protected $guardaded = ['id'];

    public function produtos()
    {
        return $this->belongsToMany('App\Models\Produto', 'material_produto')->withPivot('peso_bruto', 'peso_liquido', 'percentual_composicao');
    }

    public function produtoSegregado()
    {
        return $this->belongsTo('App\Models\ProdutoSegregados', 'material_id', 'id');
    }

    public function gerador()
    {
        return $this->hasOne('App\Models\PessoaJuridica', 'id', 'gerador_id');
    }

    public function tipo_material()
    {
        return $this->hasOne('App\Models\TipoMaterial', 'id', 'tipo_material_id');
    }

    public function unidade()
    {
        return $this->hasOne('App\Models\Unidade', 'id', 'unidade_id');
    }

    public function ibama()
    {
        return $this->hasOne('App\Models\Ibama', 'id', 'ibama_id');
    }
}
