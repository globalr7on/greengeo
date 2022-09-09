<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrdenServicoIten extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'orden_servico_itens';
    protected $fillable = [
        'peso',
        'quantidade',
        'observacao',
        'peso_controle_transportador',
        'peso_controle_destinador',
        'ordem_servico_id',
        'produto_id',
        'tratamento_id',
        'ativo',
    ];
    protected $guardaded = ['id'];

    public function ordem_servico()
    {
        return $this->belongsTo('App\Models\OrdensServicos', 'id', 'ordem_servico_id');
    }

    public function produto()
    {
        return $this->hasOne('App\Models\Produto', 'id', 'produto_id');
    }

    public function tratamento()
    {
        return $this->hasOne('App\Models\Tratamento', 'id', 'tratamento_id');
    }
}
