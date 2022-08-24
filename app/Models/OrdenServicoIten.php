<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenServicoIten extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'orden_servico_itens';
    protected $fillable = [
        'peso',
        'observacao_justificada',
        'altura',
        'largura',
        'profundidade',
        'orden_servico_id',
        'material_id',
        'acondicionamento_id',
        'tratamento_id',
    ];
    protected $guardaded = ['id'];
    
    public function orden_servico()
    {
        return $this->belongsTo('App\Models\OrdensServicos', 'id', 'orden_servico_id');
    }
}
