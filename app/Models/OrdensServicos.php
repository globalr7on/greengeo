<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;

class OrdensServicos extends Model
{
    use  HasFactory, Notifiable;
    protected $table = 'ordens_servicos';
    protected $fillable = [
        'data_estagio',
        'mtr',
        'emissao',
        'preenchimento',
        'integracao',
        'serie', 
        'cdf_serial',
        'cdf_ano',
        'description',
        'peso_total_os',
        'area_total',
        'peso_de_controle',
        'estagio_id',
        'gerador_id',
        'transportador_id',
        'destinador_id',
        'motorista_id',
        'veiculo_id',
        'nota_fiscal_id',
    ];
    protected $guardaded = ['id'];

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

    public function nota_fiscal()
    {
        return $this->hasOne('App\Models\NotaFiscal', 'id', 'nota_fiscal_id');
    }

    public function imagens()
    {
        return $this->hasMany('App\Models\Imagen', 'orden_servico_id', 'id');
    }
}
