<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class NotaFiscalIten extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'nota_fiscal_itens';
    protected $fillable = [
        'quantidade',
        'numero_de_serie',
        'data_de_fabricacao',
        'itenable_id',
        'itenable_type',
        'nota_fiscal_id',
        'usuario_responsavel_cadastro_id'
    ];
    protected $guardaded = ['id'];
    
    public function nota_fiscal()
    {
        return $this->belongsTo('App\Models\NotaFiscal', 'id', 'nota_fiscal_id');
    }

    public function usuario_responsavel_cadastro()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_responsavel_cadastro_id');
    }

    public function itenable()
    {
        return $this->morphTo();
    }
}
