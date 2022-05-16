<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Acondicionamento extends Model
{
    // use HasFactory;
    use HasApiTokens, HasFactory, Notifiable;
    
    
    protected $table = 'acondicionamentos';
    protected $fillable = ['descricao','ativo'];
  
    protected $guardaded=['id'];

}