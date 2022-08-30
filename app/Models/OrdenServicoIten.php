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
        'observacao',
        'numero_de_serie',
        'data_de_fabricacao',
        'orden_servico_id',
        'produto_id',
        'tratamento_id',
        'nota_fiscal_item_id',
    ];
    protected $guardaded = ['id'];
    
    public function orden_servico()
    {
        return $this->belongsTo('App\Models\OrdensServicos', 'id', 'orden_servico_id');
    }

    public function produto()
    {
        return $this->hasOne('App\Models\Produto', 'id', 'produto_id');
    }

    public function tratamento()
    {
        return $this->hasOne('App\Models\Tratamento', 'id', 'tratamento_id');
    }

    public function nota_fiscal_item()
    {
        return $this->hasOne('App\Models\NotaFiscalIten', 'id', 'nota_fiscal_item_id');
    }
}
