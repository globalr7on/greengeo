<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TipoAcessante extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tipo_acessantes';
    protected $fillable = ['descricao', 'ativo'];
    protected $guardaded = ['id'];

    public function atividades()
    {
        return $this->belongsToMany('App\Models\Atividade','juridica_x_tipo', 'atividade_id', 'id');
    }

}
