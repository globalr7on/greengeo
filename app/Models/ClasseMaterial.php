<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClasseMaterial extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    // protected $table = 'classe_material';
    // protected $fillable = [];
    // protected $guardaded = ['id'];
}
