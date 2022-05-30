<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdensServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens_servicos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data_estagio');
            $table->integer('mtr');
            $table->dateTime('emissao');
            $table->dateTime('preenchimento');
            $table->dateTime('integracao');
            $table->string('serie', 2);
            $table->integer('cdf_serial');
            $table->integer('cdf_ano');
            $table->text('description', 100);
            $table->decimal('peso_total_os', $precision = 6, $scale = 2);
            $table->decimal('area_total', $precision = 6, $scale = 2);
            $table->decimal('peso_de_controle', $precision = 6, $scale = 2);
            $table->unsignedBigInteger('estagio_id');
            $table->foreign('estagio_id')->references('id')->on('estagios');
            $table->unsignedBigInteger('gerador_id');
            $table->foreign('gerador_id')->references('id')->on('pessoas_juridicas');
            $table->unsignedBigInteger('transportador_id');
            $table->foreign('transportador_id')->references('id')->on('pessoas_juridicas');
            $table->unsignedBigInteger('destinador_id');
            $table->foreign('destinador_id')->references('id')->on('pessoas_juridicas');
            $table->unsignedBigInteger('motorista_id');
            $table->foreign('motorista_id')->references('id')->on('acessantes');
            $table->unsignedBigInteger('veiculo_id');
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
            $table->unsignedBigInteger('nota_fiscal_id');
            $table->foreign('nota_fiscal_id')->references('id')->on('notas_fiscais');
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
        Schema::dropIfExists('ordens_servicos');
    }
}
