<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersExtraFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cpf');
            $table->string('rg');
            $table->string('cargo')->nullable();;
            $table->string('celular')->nullable();;
            $table->string('fixo')->nullable();
            $table->string('whats')->nullable();
            $table->string('endereco')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('cep')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('registro_carteira')->nullable();
            $table->string('tipo_carteira')->nullable();
            $table->date('validade_carteira')->nullable();
            $table->boolean('ativo')->default(true);
            $table->string('identificador_celular')->nullable();
            $table->unsignedBigInteger('usuario_responsavel_cadastro_id')->nullable();
            $table->foreign('usuario_responsavel_cadastro_id')->references('id')->on('users');
            $table->unsignedBigInteger('pessoa_juridica_id')->nullable();
            $table->foreign('pessoa_juridica_id')->references('id')->on('pessoas_juridicas');
          
        });
    }

    // /**
    //  * Reverse the migrations.
    //  *
    //  * @return void
    //  */
    // public function down()
    // {
    //     Schema::dropIfExists('users_extra_fields');
    // }
}
