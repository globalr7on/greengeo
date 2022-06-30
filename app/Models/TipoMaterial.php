<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TipoMaterial extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'tipo_materiais';
    protected $fillable = [
        'descricao'
    ];
    protected $guardaded = ['id'];
}
