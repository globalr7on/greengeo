<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class NotaFiscal extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'notas_fiscais';
    // protected $fillable = [];
    protected $guardaded = ['id'];
}
