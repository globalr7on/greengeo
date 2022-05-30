<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasJuridicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas_juridicas', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj', 18);
            $table->string('nome_fantasia', 50);  
            $table->string('razao_social', 50);
            $table->string('email', 40);
            $table->string('contato_1', 40);
            $table->string('cargo_contato_1', 40);
            $table->string('contato_2', 40);
            $table->string('cargo_contato_2', 40);
            $table->string('celular_contato_1', 15);
            $table->string('celular_contato_2', 15);
            $table->string('fixo', 15);
            $table->string('whatsapp', 15);
            $table->string('endereco', 50);
            $table->smallInteger('numero');
            $table->string('complemento', 30);
            $table->string('cep', 10);
            $table->string('bairro', 20);
            $table->string('cidade', 45);
            $table->string('estado', 2);
            $table->string('latitude', 10);
            $table->string('longitude', 10);
            $table->string('contrato', 10);
            $table->boolean('ativo')->default(true);
            $table->string('identificador_celular', 20);
            $table->string('senha_acesso', 10);
            $table->decimal('capacidade_media_carga', 6,2)->default(0);
            $table->unsignedBigInteger('usuario_responsavel_cadastro_id');
            $table->foreign('usuario_responsavel_cadastro_id')->references('id')->on('users');
            $table->unsignedBigInteger('juridica_x_tipo_id');
            $table->foreign('juridica_x_tipo_id')->references('id')->on('juridica_x_tipos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoas_juridicas');
    }
}
