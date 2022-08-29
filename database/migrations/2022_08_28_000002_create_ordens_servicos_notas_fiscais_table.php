<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdensServicosNotasFiscaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens_servicos_notas_fiscais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ordem_servico_id');
            $table->foreign('ordem_servico_id')->references('id')->on('ordens_servicos');
            $table->unsignedBigInteger('nota_fiscal_id');
            $table->foreign('nota_fiscal_id')->references('id')->on('notas_fiscais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_servico_motoristas');
    }
}
