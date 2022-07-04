<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Material extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'materiais';
    protected $fillable = [
        'ean', 
        'ibama', 
        'denominacao_ibama',
        'peso_bruto', 
        'peso_liquido', 
        'estado_fisico', 
        'percentual_composicao', 
        'dimensoes', 
        'largura', 
        'profundidade', 
        'comprimento', 
        'nome_no_fabricante', 
        'especie', 
        'marca', 
        'gerador_id', 
        'tipo_material_id', 
        'classe_material_id', 
        'unidade_id', 
        'nota_fical_iten_id'];

    protected $guardaded = ['id'];

    public function produtos()
    {
        return $this->belongsToMany('App\Models\Produto', 'material_produto');
    }
}
