<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    // protected $table = 'material';
    // protected $fillable = [];
    // protected $guardaded = ['id'];
}
