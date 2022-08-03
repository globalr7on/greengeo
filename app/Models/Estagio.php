<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Estagio extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'estagios';
    protected $fillable = [
        'descricao'
    ]; 
    protected $guardaded = ['id'];

    public function ordens_servicos()
    {
        return $this->belongsTo('App\Models\OrdensServicos', 'estagio_id', 'id');
    }
}
