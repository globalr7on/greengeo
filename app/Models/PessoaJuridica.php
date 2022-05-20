<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class PessoaJuridica extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'pessoa_juridicas';
    protected $fillable = ['tipo','cnpj', 'nome_fantasia', 'razao_social', 'email', 'contato_1', 'cargo_contato_1', 'contato_2', 'cargo_contato_2', 'celular_contato_1', 'celular_contato_2', 'fixo', 'whatsapp', 'endereco', 'numero', 'complemento', 'cep', 'bairro', 'cidade', 'estado',  'latitude', 'longitude', 'contrato', 'ativo', 'identificador_celular','senha_acesso','capacidade_media_carga','usuario_responsavel_cadastro_id'];
  

    protected $guardaded=['id'];


    public function usuario_responsavel_cadastro()
    {
        return $this->hasOne('App\Models\User');
    }

    public function veiculo()
    {
        return $this->belongsTo('App\Models\Veiculo', 'pessoa_juridicas_id', 'id');
    }


    // public function getAcessantes()
    // {
    //     return $this->belongsTo('App\Models\Users', 'usuario_responsavel_cadastro_id', 'id');
    // }
    
  
}
