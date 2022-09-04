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
            $table->dropColumn(['nota_fiscal_item_id']);
            $table->text('observacao')->nullable()->change();
            $table->string('numero_serie')->nullable()->change();
            $table->renameColumn('data_de_fabricacao', 'data_fabricacao')->nullable()->change();
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
