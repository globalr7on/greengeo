<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Atividade extends Model
{
    use HasApiTokens, HasFactory, Notifiable;   
    protected $table = 'atividades';
    protected $fillable = [
        'descricao',
        'ativo'
    ];
    protected $guardaded = ['id'];


    public function tipo_acessantes()
    {
        return $this->belongsToMany('App\Models\TipoAcessante','juridica_x_tipo', 'tipo_acessante_id', 'id');
    }
}