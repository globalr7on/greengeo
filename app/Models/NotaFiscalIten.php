<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaFiscalIten extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    // protected $table = 'nota_fiscal_iten';
    // protected $fillable = [];
    // protected $guardaded = ['id'];
}
