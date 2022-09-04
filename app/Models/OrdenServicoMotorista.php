<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class OrdenServicoMotorista extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'orden_servico_motoristas';
    protected $fillable = [
        'usuario_id',
        'ordem_servico_id',
        'status',
    ];
    protected $guardaded = ['id'];

    public function ordem_servico()
    {
        return $this->belongsTo('App\Models\OrdensServicos', 'id', 'ordem_servico_id');
    }

    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }
}
