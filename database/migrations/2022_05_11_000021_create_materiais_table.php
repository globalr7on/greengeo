<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiais', function (Blueprint $table) {
            $table->id();
            $table->string('ean', 20 );
            $table->integer('ibama');
            $table->string('denominacao_ibama', 45);
            $table->decimal('peso_bruto', $precision = 4, $scale = 2);
            $table->decimal('peso_liquido', $precision = 4, $scale = 2);
            $table->string('estado_fisico', 10);
            $table->decimal('percentual_composicao', $precision = 4, $scale = 2);
            $table->boolean('ativo')->default(true);
            $table->string('dimensoes', 30);
            $table->decimal('largura', $precision = 6, $scale = 2);
            $table->decimal('profundidade', $precision = 6, $scale = 2);
            $table->decimal('comprimento', $precision = 6, $scale = 2);
            $table->string('nome_no_fabricante', 45);
            $table->string('especie', 45);
            $table->string('marca', 45);
            $table->unsignedBigInteger('gerador_id');
            $table->foreign('gerador_id')->references('id')->on('pessoas_juridicas');
            $table->unsignedBigInteger('tipo_material_id');
            $table->foreign('tipo_material_id')->references('id')->on('tipo_materiais');
            $table->unsignedBigInteger('classe_material_id');
            $table->foreign('classe_material_id')->references('id')->on('classe_materiais');
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
            $table->unsignedBigInteger('nota_fiscal_iten_id');
            $table->foreign('nota_fiscal_iten_id')->references('id')->on('nota_fiscal_itens');
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
        Schema::dropIfExists('materiais');
    }
}
