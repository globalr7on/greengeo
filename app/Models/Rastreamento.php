<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Rastreamento extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'rastreamentos';
    protected $fillable = [
        'latitude',
        'longitude',
        'orden_servico_id',
    ];
    protected $guardaded = ['id'];

    public function orden_servico()
    {
        return $this->hasOne('App\Models\OrdensServicos', 'id', 'orden_servico_id');
    }
}
