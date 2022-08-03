<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNameImagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagens', function (Blueprint $table) {
            $table->dropForeign('imagens_ordens_servicos_id_foreign');
            $table->dropColumn(['ordens_servicos_id']);
            $table->unsignedBigInteger('orden_servico_id');
            $table->foreign('orden_servico_id')->references('id')->on('ordens_servicos');
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
