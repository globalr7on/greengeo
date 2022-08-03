<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ClasseSucata extends Model
{
    use HasApiTokens, HasFactory, Notifiable;   
    protected $table = 'classe_sucatas';
    protected $fillable = [
        'descricao',
    ];
    protected $guardaded = ['id'];

    public function ibamas()
    {
        return $this->hasMany('App\Models\Ibama', 'classe_sucata_id', 'id');
    }
}
