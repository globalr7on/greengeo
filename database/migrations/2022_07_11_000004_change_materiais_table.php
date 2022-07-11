<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeMateriaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table ('materiais', function (Blueprint $table) {
            $table->dropForeign('materiais_classe_material_id_foreign');
            $table->dropForeign('materiais_nota_fiscal_iten_id_foreign');
            $table->dropColumn(['ean','ibama', 'denominacao_ibama','peso_bruto','peso_liquido','percentual_composicao', 'dimensoes', 'largura', 'profundidade', 'comprimento', 'nome_no_fabricante','especie','marca', 'classe_material_id', 'nota_fiscal_iten_id' ]);
            $table->unsignedBigInteger('ibama_id');
            $table->foreign('ibama_id')->references('id')->on('ibamas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
