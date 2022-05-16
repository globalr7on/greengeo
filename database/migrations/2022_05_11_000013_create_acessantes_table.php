<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcessantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acessantes', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['fisica', 'judirica']);
            $table->string('cpf');
            $table->string('rg');
            $table->string('nome');
            $table->string('email');
            $table->string('cargo');
            $table->string('celular');
            $table->string('fixo');
            $table->string('whats');
            $table->string('endereco');
            $table->string('numero');
            $table->string('complemento');
            $table->string('cep');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado');
            $table->string('registro_carteira');
            $table->string('tipo_carteira');
            $table->date('validade_carteira');
            $table->string('ativo');
            $table->string('identificador_celular');
            $table->string('senha_acesso');
            $table->unsignedBigInteger('usuario_responsavel_cadastro_id');
            $table->foreign('usuario_responsavel_cadastro_id')->references('id')->on('users');

            $table->unsignedBigInteger('pessoa_juridicas_id');
            $table->foreign('pessoa_juridicas_id')->references('id')->on('pessoa_juridicas');

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
        Schema::dropIfExists('acessantes');
    }
}
