<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class JuridicaXTipo extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'juridica_x_tipos';
    protected $fillable = ['tipo_acessante_id', 'atividade_id' ];
    protected $guardaded = ['id'];

    public function tipo_acessantes()
    {
        return $this->hasMany('App\Models\Acessante');
    }

    public function atividades()
    {
        return $this->hasMany('App\Models\Atividade');
    }
}
