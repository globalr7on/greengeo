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

            $table->unsignedBigInteger('gerador_id');
            $table->foreign('gerador_id')->references('id')->on('pessoa_juridicas');

            $table->unsignedBigInteger('tipo_materials_id');

            $table->foreign('tipo_materials_id')->references('id')->on('tipo_materials');
            
            $table->unsignedBigInteger('classe_materials_id');

            $table->foreign('classe_materials_id')->references('id')->on('classe_materials');
            
            $table->unsignedBigInteger('unidades_id');

            $table->foreign('unidades_id')->references('id')->on('unidades');

            $table->unsignedBigInteger('itens_fiscais_id');

            $table->foreign('itens_fiscais_id')->references('id')->on('itens_fiscais');

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
