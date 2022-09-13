<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroEstagio extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'registros_estagisos';
    // protected $fillable = [];
    // protected $guardaded = ['id'];
}
