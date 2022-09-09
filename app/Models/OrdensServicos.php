<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class OrdensServicos extends Model
{
    use  HasFactory, Notifiable;
    protected $table = 'ordens_servicos';
    protected $fillable = [
        'codigo',
        'data_estagio',
        'data_emissao',
        'data_preenchimento',
        'data_integracao',
        'description',
        'estagio_id',
        'gerador_id',
        'transportador_id',
        'destinador_id',
        'motorista_id',
        'veiculo_id',
        'mtr_link',
        'cdf_link',
        'acondicionamento_id',
        'data_inicio_coleta',
        'data_final_coleta',
        'responsavel_id'
    ];
    protected $guardaded = ['id'];

    public function getPesoTotalAttribute()
    {
        return $this->itens ? number_format($this->itens->sum('peso'), 2) : null;
    }

    public function estagio()
    {
        return $this->hasOne('App\Models\Estagio', 'id', 'estagio_id');
    }

    public function gerador()
    {
        return $this->hasOne('App\Models\PessoaJuridica', 'id', 'gerador_id');
    }

    public function transportador()
    {
        return $this->hasOne('App\Models\PessoaJuridica', 'id', 'transportador_id');
    }

    public function destinador()
    {
        return $this->hasOne('App\Models\PessoaJuridica', 'id', 'destinador_id');
    }

    public function motorista()
    {
        return $this->hasOne('App\Models\User', 'id', 'motorista_id');
    }

    public function veiculo()
    {
        return $this->hasOne('App\Models\Veiculo', 'id', 'veiculo_id');
    }

    public function acondicionamento()
    {
        return $this->hasOne('App\Models\Acondicionamento', 'id', 'acondicionamento_id');
    }

    public function responsavel()
    {
        return $this->hasOne('App\Models\User', 'id', 'responsavel_id');
    }

    public function itens()
    {
        return $this->hasMany('App\Models\OrdenServicoIten', 'ordem_servico_id', 'id');
    }

    public function imagens()
    {
        return $this->hasMany('App\Models\Imagen', 'orden_servico_id', 'id');
    }

    public function aprovacao_motorista()
    {
        return $this->hasMany('App\Models\OrdenServicoMotorista', 'ordem_servico_id', 'id');
    }

    public function estagios_historico()
    {
        return $this->hasMany('App\Models\OrdenServicoEstagio', 'ordem_servico_id', 'id');
    }
}
