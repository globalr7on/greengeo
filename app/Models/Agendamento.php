<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Agendamento extends Model
{
    use HasApiTokens, HasFactory, Notifiable;   
    protected $table = 'agendamentos';
    protected $fillable = [
        'usuario_id',
        'ordem_servico_id',
        'acondicionamento_id',
        'transportadora_id',
        'coleta'
    ];
    protected $guardaded = ['id'];

    public function usuario_responsavel_cadastro()
    {
        return $this->hasOne('App\Models\User', 'usuario_id', 'id');
    }

    public function transportador()
    {
        return $this->hasOne('App\Models\PessoaJuridica', 'id', 'transportadora_id');
    }

    public function acondicionamento()
    {
        return $this->hasOne('App\Models\Acondicionamento', 'id', 'acondicionamento_id');
    }

    public function ordem_servico()
    {
        return $this->hasOne('App\Models\OrdensServicos', 'id', 'ordem_servico_id');
    }
}
