<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rastreamento extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'rastreamentoss';
    // protected $fillable = [];
    // protected $guardaded = ['id'];
}
