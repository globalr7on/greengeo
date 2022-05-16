<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('chassis', 20);
            $table->string('placa', 10);
            $table->decimal('capacidade_media_carga', $precision = 6, $scale = 2);
            $table->string('renavam', 15);
            $table->string('combustivel', 10);
            $table->boolean('ativo')->default(true);

            $table->unsignedBigInteger('pessoa_juridicas_id');

            $table->foreign('pessoa_juridicas_id')->references('id')->on('pessoa_juridicas');

            $table->unsignedBigInteger('modelos_id');

            $table->foreign('modelos_id')->references('id')->on('modelos');

            $table->unsignedBigInteger('marcas_id');

            $table->foreign('marcas_id')->references('id')->on('marcas');

            $table->unsignedBigInteger('acondicionamento_id');

            $table->foreign('acondicionamento_id')->references('id')->on('acondicionamentos');
          
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
        Schema::dropIfExists('veiculos');
    }
}
