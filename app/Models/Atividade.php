<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Atividade extends Model
{
    use HasApiTokens, HasFactory, Notifiable;   
    protected $table = 'atividades';
    protected $fillable = [
        'descricao',
        'ativo'
    ];
    protected $guardaded = ['id'];

    public function pessoa_juridica()
    {
        return $this->belongsTo('App\Models\PessoaJuridica');
    }
}