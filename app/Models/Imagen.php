<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    // protected $table = 'imagen';
    // protected $fillable = [];
    // protected $guardaded = ['id'];
}
