<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Acessante extends Model
{
    // use HasFactory;
    use HasApiTokens, HasFactory, Notifiable;
    
    
    protected $table = 'acessantes';
    protected $fillable = ['cpf', 'rg', 'nome', 'email', 'cargo', 'celular', 'fixo', 'whats', 'endereco', 'numero', 'complemento', 'cep', 'bairro', 'cidade', 'estado', 'registro_carteira', 'tipo_carteira', 'validade_carteira', 'usuario_responsavel_cadastro', 'ativo', 'identificador_celular', 'senha_acesso'];
  

    protected $guardaded=['id'];
}
