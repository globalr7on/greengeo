<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaFiscal extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    // protected $table = 'nota_fiscal';
    // protected $fillable = [];
    // protected $guardaded = ['id'];
}
