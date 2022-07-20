<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNotaFiscalItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nota_fiscal_itens', function (Blueprint $table) {
            $table->dropForeign('nota_fiscal_itens_unidade_id_foreign');
            $table->dropColumn(['ean','peso', 'largura', 'profundidade','comprimento','especie','marca','codigo_do_fabricante','unidade_id']);
            $table->morphs('item');
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
