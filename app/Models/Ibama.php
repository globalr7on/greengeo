<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Ibama extends Model
{
   use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'ibamas';
    protected $fillable = [
        'codigo',
        'denominacao'
    ]; 
    protected $guardaded = ['id'];
}
