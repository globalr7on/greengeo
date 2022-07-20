<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProdutoSegregados extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'produto_segregados';
    protected $fillable = [
        'material_id',
        'peso_bruto',
        'peso_liquido', 
        'percentual_composicao',
        
    ];
    protected $guardaded = ['id'];
    
    public function item()
    {
        return $this->morphOne(NotaFiscalItem::class, 'item');
    }
}
