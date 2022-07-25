<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Imagen extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'imagens';
    protected $fillable = [
        'url',
        'nome_arquivo',
        'orden_servico_iten_id'
    ];
    protected $guardaded = ['id'];
}
