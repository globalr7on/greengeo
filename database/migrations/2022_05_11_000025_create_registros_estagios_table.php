<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosEstagiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros_estagios', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data_lancamento');
            $table->unsignedBigInteger('orden_servico_id');
            $table->foreign('orden_servico_id')->references('id')->on('ordens_servicos');
            $table->unsignedBigInteger('estagio_id');
            $table->foreign('estagio_id')->references('id')->on('estagios');
            $table->unsignedBigInteger('acessante_id');
            $table->foreign('acessante_id')->references('id')->on('acessantes');
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
        Schema::dropIfExists('registros_estagio');
    }
}
