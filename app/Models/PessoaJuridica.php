<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PessoaJuridica extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'pessoas_juridicas';
    protected $fillable = [
        'cnpj',
        'nome_fantasia',
        'razao_social',
        'email',
        'contato_1',
        'cargo_contato_1',
        'contato_2',
        'cargo_contato_2',
        'celular_contato_1',
        'celular_contato_2',
        'fixo',
        'whatsapp',
        'endereco',
        'numero',
        'complemento',
        'cep',
        'bairro',
        'cidade',
        'estado', 
        'latitude',
        'longitude',
        'contrato',
        'ativo',
        'identificador_celular',
        'senha_acesso',
        'usuario_responsavel_cadastro_id',
        'atividade_id',
        'tipo_empresa_id'
    ];
    protected $guardaded = ['id'];
    protected $appends = ['capacidade_media_carga'];

    public function getCapacidadeMediaCargaAttribute()
    {
        return $this->veiculo ? $this->veiculo->sum('capacidade_media_carga') : null;
    }

    public function usuario_responsavel_cadastro()
    {
        return $this->hasOne('App\Models\User', 'usuario_responsavel_cadastro_id', 'id');
    }

    public function tipo_empresa()
    {
        return $this->hasOne('App\Models\TipoEmpresa', 'id', 'tipo_empresa_id');
    }

    public function atividade()
    {
        return $this->hasOne('App\Models\Atividade', 'id', 'atividade_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'usuario_responsavel_cadastro_id', 'id');
    }

    public function veiculo()
    {
        return $this->belongsTo('App\Models\Veiculo', 'id', 'pessoa_juridica_id');
    }
}