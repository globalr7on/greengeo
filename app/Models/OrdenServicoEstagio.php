<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class OrdenServicoEstagio extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'orden_servico_estagios';
    protected $fillable = [
        'ordem_servico_id',
        'estagio_id',
        'responsavel_id',
    ];
    protected $guardaded = ['id'];

    public function ordem_servico()
    {
        return $this->belongsTo('App\Models\OrdensServicos', 'id', 'ordem_servico_id');
    }

    public function estagio()
    {
        return $this->hasOne('App\Models\Estagio', 'id', 'estagio_id');
    }

    public function responsavel()
    {
        return $this->hasOne('App\Models\User', 'id', 'responsavel_id');
    }
}
