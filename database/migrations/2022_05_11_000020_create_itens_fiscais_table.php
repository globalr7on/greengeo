<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItensFiscaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_fiscais', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('nota_fiscals_id');

            $table->foreign('nota_fiscals_id')->references('id')->on('nota_fiscals');

            $table->unsignedBigInteger('unidades_id');

            $table->foreign('unidades_id')->references('id')->on('unidades');

            $table->unsignedBigInteger('acessantes_id');

            $table->foreign('acessantes_id')->references('id')->on('acessantes');

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
        Schema::dropIfExists('itens_fiscais');
    }
}
