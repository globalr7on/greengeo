<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeImagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagens', function (Blueprint $table) {
            $table->dropForeign('imagens_orden_servico_iten_id_foreign');
            $table->dropColumn(['nome_arquivo','orden_servico_iten_id']);
            $table->text('url')->change();
            $table->unsignedBigInteger('ordens_servicos_id');
            $table->foreign('ordens_servicos_id')->references('id')->on('ordens_servicos');
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
