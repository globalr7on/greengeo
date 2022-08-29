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
        'mtr',
        'data_estagio',
        'emissao',
        'preenchimento',
        'integracao',
        'serie', 
        'cdf_serial',
        'cdf_ano',
        'description',
        'peso_de_controle',
        'estagio_id',
        'gerador_id',
        'transportador_id',
        'destinador_id',
        'motorista_id',
        'veiculo_id',
    ];
    protected $guardaded = ['id'];

    public function getPesoTotalAttribute()
    {
        return $this->itens ? $this->itens->sum('peso') : null;
    }

    public function notas_fiscais()
    {
        return $this->belongsToMany('App\Models\NotaFiscal', 'ordens_servicos_notas_fiscais', 'ordem_servico_id', 'nota_fiscal_id');
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

    public function itens()
    {
        return $this->hasMany('App\Models\OrdenServicoIten', 'orden_servico_id', 'id');
    }

    public function imagens()
    {
        return $this->hasMany('App\Models\Imagen', 'orden_servico_id', 'id');
    }
    
    public function aprovacao_motorista()
    {
        return $this->hasMany('App\Models\OrdenServicoMotorista', 'ordem_servico_id', 'id');
    }
}
