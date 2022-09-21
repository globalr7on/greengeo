<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TipoEmpresa extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'tipo_empresa';
    protected $fillable = [
        'descricao',
        'ativo'
    ];
    protected $guardaded = ['id'];

    public function pessoas_juridicas()
    {
        return $this->belongsTo('App\Models\PessoaJuridica', 'tipo_empresa_id', 'id');
    }
}
