<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envolvidos extends Model
{
    use HasFactory;

    protected $table = "envolvidos";

    protected $fillable = ['id_empresa', 'fisica_juridica', 'cpf', 'cnpj', 'rg', 'nome', 'razao_social','email','contato_1','cargo_contato_1','contato_2','cargo_contato_2','celular_contato_1','celular_contato_2','fixo','whatsapp','endereco','numero','complemento','cep','bairro','cidade','estado','latitude','logintude','contrato','registro_carteira','tipo_carteira','validade_carteira','usuario_responsavel_cadastro','ativo','identificador_celular','senha_acesso','capacidade_media_carga'];


}
