<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Veiculo extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $table = 'veiculos';
    protected $fillable = [
        'chassis',
        'placa',
        'capacidade_media_carga',
        'renavam',
        'combustivel',
        'ativo',
        'pessoa_juridica_id',
        'modelo_id',
        'marca_id',
        'acondicionamento_id'
    ];
    protected $guardaded = ['id'];

    public function pessoa_juridica()
    {
        // return $this->hasOne('App\Models\PessoaJuridica');
        return $this->hasOne('App\Models\PessoaJuridica', 'id', 'pessoa_juridica_id');
    }

    public function modelo()
    {
        // return $this->hasOne('App\Models\Modelo');
        return $this->hasOne('App\Models\Modelo', 'id', 'modelo_id');
    }

    public function marca()
    {
        // return $this->hasOne('App\Models\Marca');
        return $this->hasOne('App\Models\Marca', 'id', 'marca_id');
    }

    public function acondicionamento()
    {
        // return $this->hasOne('App\Models\Acondicionamento');
        return $this->hasOne('App\Models\Acondicionamento', 'id', 'acondicionamento_id');
    }

}
