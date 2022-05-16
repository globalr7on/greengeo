<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRastreamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rastreamentos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('orden_de_servicos_id');

            $table->foreign('orden_de_servicos_id')->references('id')->on('orden_de_servicos');

            $table->string('identificador', 50); 
            $table->string('latitude', 15); 
            $table->string('longitude', 15); 
            $table->dateTime('data_hora_satelite');
            $table->decimal('velocidade', $precision = 6, $scale = 2);
            $table->string('logradouro', 100); 
            $table->string('bairro', 45); 
            $table->string('cidade', 45); 
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
        Schema::dropIfExists('rastreamentos');
    }
}
