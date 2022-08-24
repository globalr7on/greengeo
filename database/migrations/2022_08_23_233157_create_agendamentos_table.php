<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->unsignedBigInteger('ordem_servico_id');
            $table->foreign('ordem_servico_id')->references('id')->on('ordens_servicos');
            $table->unsignedBigInteger('acondicionamento_id');
            $table->foreign('acondicionamento_id')->references('id')->on('acondicionamentos');
            $table->unsignedBigInteger('transportadora_id');
            $table->foreign('transportadora_id')->references('id')->on('pessoas_juridicas');
            $table->dateTime('coleta');
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
        Schema::dropIfExists('agendamentos');
    }
}
