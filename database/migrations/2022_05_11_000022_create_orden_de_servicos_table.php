<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenDeServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_de_servicos', function (Blueprint $table) {
            $table->id();

            
            $table->unsignedBigInteger('estagios_os_id');

            $table->foreign('estagios_os_id')->references('id')->on('estagios_os');
            
            $table->dateTime('data_estagio');
            
            $table->integer('mtr');

            $table->unsignedBigInteger('gerador_id');

            $table->foreign('gerador_id')->references('id')->on('pessoa_juridicas');
            
            $table->unsignedBigInteger('transportador_id');

            $table->foreign('transportador_id')->references('id')->on('pessoa_juridicas');
            
            $table->unsignedBigInteger('destinador_id');

            $table->foreign('destinador_id')->references('id')->on('pessoa_juridicas');
            
            $table->unsignedBigInteger('motorista_id');

            $table->foreign('motorista_id')->references('id')->on('acessantes');

            $table->unsignedBigInteger('veiculos_id');

            $table->foreign('veiculos_id')->references('id')->on('veiculos');

            $table->unsignedBigInteger('nota_fiscals_id');

            $table->foreign('nota_fiscals_id')->references('id')->on('nota_fiscals');

            $table->dateTime('emissao');

            $table->dateTime('preenchimento');

            $table->dateTime('integracao');
            
            $table->string('serie', 2);

            $table->integer('CDF_Serial');

            $table->integer('CDF_Ano');

            $table->text('description', 100);

            $table->decimal('peso_total_os', $precision = 6, $scale = 2);

            $table->decimal('area_total', $precision = 6, $scale = 2);

            $table->decimal('peso_de_controle', $precision = 6, $scale = 2);

            



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
        Schema::dropIfExists('orden_de_servicos');
    }
}
