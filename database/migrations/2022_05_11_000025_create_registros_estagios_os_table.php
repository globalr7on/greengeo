<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosEstagiosOsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros_estagios_os', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orden_de_servicos_id');

            $table->foreign('orden_de_servicos_id')->references('id')->on('orden_de_servicos');

            $table->unsignedBigInteger('estagios_os_id');

            $table->foreign('estagios_os_id')->references('id')->on('estagios_os');

            $table->unsignedBigInteger('acessantes_id');

            $table->foreign('acessantes_id')->references('id')->on('acessantes');

            $table->dateTime('data_lancamento');
           
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
        Schema::dropIfExists('registros_estagios_os');
    }
}
