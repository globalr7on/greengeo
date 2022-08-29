<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdenServicoItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orden_servico_itens', function (Blueprint $table) {
            $table->renameColumn('observacao_justificada', 'observacao');
            $table->dropForeign('orden_servico_itens_material_id_foreign');
            $table->dropForeign('orden_servico_itens_acondicionamento_id_foreign');
            $table->dropColumn(['material_id', 'acondicionamento_id', 'altura', 'largura', 'profundidade']);
            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')->references('id')->on('produto_acabado');
            $table->string('numero_de_serie', 20);
            $table->date('data_de_fabricacao');
            $table->unsignedBigInteger('nota_fiscal_item_id')->nullable();
            $table->foreign('nota_fiscal_item_id')->references('id')->on('nota_fiscal_itens');
            $table->text('observacao')->nullable()->change();            
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
