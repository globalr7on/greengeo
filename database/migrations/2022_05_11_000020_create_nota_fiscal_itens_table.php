<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaFiscalItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_fiscal_itens', function (Blueprint $table) {
            $table->id();
            $table->string('ean', 20);
            $table->string('descricao', 20);
            $table->string('peso', 20);
            $table->string('largura', 20);
            $table->string('profundidade', 20);
            $table->string('comprimento', 20);
            $table->string('quantidade', 20);
            $table->string('especie', 20);
            $table->string('marca', 20);
            $table->string('codigo_do_fabricante', 20);
            $table->string('numero_de_serie', 20);
            $table->date('data_de_fabricacao');
            $table->unsignedBigInteger('nota_fiscal_id');
            $table->foreign('nota_fiscal_id')->references('id')->on('notas_fiscais');
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
            $table->unsignedBigInteger('usuario_responsavel_cadastro_id');
            $table->foreign('usuario_responsavel_cadastro_id')->references('id')->on('users');
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
        Schema::dropIfExists('nota_fiscal_itens');
    }
}
