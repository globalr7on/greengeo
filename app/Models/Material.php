<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
    ];

    protected $guardaded = ['id'];

    public function produtos()
    {
        return $this->belongsToMany('App\Models\Produto', 'material_produto')->withPivot('pesso_bruto', 'pesso_liquido', 'percentual_composicao');
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
        return $this->hasOne('App\Models\PessoaJuridica', 'id', 'unidade_id');
    }

    public function ibama()
    {
        return $this->hasOne('App\Models\PessoaJuridica', 'id', 'ibama_id');
    }
    

}
