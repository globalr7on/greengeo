<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Marca extends Model
{
    use HasApiTokens, HasFactory, Notifiable;   
    protected $table = 'marcas';
    protected $fillable = [
        'descricao',
        'ativo'
    ];
    protected $guardaded = ['id'];

    public function veiculo()
    {
        return $this->belongsTo('App\Models\Veiculo');
    }
}
