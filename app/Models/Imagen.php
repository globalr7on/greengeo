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
        'orden_servico_id'
    ];
    protected $guardaded = ['id'];

    public function orden_servico()
    {
        return $this->belongsTo('App\Models\OrdensServicos', 'orden_servico_id', 'id');
    }
}
