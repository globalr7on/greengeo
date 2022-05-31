<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdensServicos extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'ordens_servicos';
    protected $fillable = [];
    protected $guardaded = ['id'];
}
