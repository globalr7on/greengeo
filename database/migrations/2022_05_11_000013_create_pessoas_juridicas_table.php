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
            $table->string('contato_1', 40)->nullable();
            $table->string('cargo_contato_1', 40)->nullable();
            $table->string('contato_2', 40)->nullable();
            $table->string('cargo_contato_2', 40)->nullable();
            $table->string('celular_contato_1', 15)->nullable();
            $table->string('celular_contato_2', 15)->nullable();
            $table->string('fixo', 15)->nullable();
            $table->string('whatsapp', 15)->nullable();
            $table->string('endereco', 50)->nullable();
            $table->smallInteger('numero')->nullable();
            $table->string('complemento', 30)->nullable();
            $table->string('cep', 10)->nullable();
            $table->string('bairro', 20)->nullable();
            $table->string('cidade', 45)->nullable();
            $table->string('estado', 2)->nullable();
            $table->string('latitude', 10)->nullable();
            $table->string('longitude', 10)->nullable();
            $table->string('contrato', 10)->nullable();
            $table->boolean('ativo')->default(true);
            $table->string('identificador_celular', 20)->nullable();
            $table->string('senha_acesso', 10)->nullable();
            $table->decimal('capacidade_media_carga', 6,2)->default(0);
            $table->unsignedBigInteger('usuario_responsavel_cadastro_id')->nullable();
            $table->foreign('usuario_responsavel_cadastro_id')->references('id')->on('users');
            $table->unsignedBigInteger('atividade_id')->nullable();
            $table->foreign('atividade_id')->references('id')->on('atividades');
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
