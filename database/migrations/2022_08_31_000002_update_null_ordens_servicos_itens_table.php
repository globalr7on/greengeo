<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNullOrdensServicosItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orden_servico_itens', function (Blueprint $table) {
            $table->dropForeign('orden_servico_itens_nota_fiscal_item_id_foreign');
            $table->dropForeign('orden_servico_itens_orden_servico_id_foreign');
            $table->dropColumn(['nota_fiscal_item_id', 'orden_servico_id']);
            $table->renameColumn('numero_de_serie', 'numero_serie')->nullable()->change();
            $table->renameColumn('data_de_fabricacao', 'data_fabricacao')->nullable()->change();
            $table->unsignedBigInteger('tratamento_id')->nullable()->change();
            $table->unsignedBigInteger('ordem_servico_id');
            $table->foreign('ordem_servico_id')->references('id')->on('ordens_servicos');
            $table->integer('quantidade');
            $table->boolean('ativo')->default(true);
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
