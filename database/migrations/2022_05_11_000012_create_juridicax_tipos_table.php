<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJuridicaxTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juridicax_tipos', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('pessoa_juridicas_id');
            $table->foreign('pessoa_juridicas_id')->references('id')->on('pessoa_juridicas');

            $table->unsignedBigInteger('tipo_acessantes_id');
            $table->foreign('tipo_acessantes_id')->references('id')->on('tipo_acessantes');
            
            $table->unsignedBigInteger('atividades_id');
            $table->foreign('atividades_id')->references('id')->on('atividades');

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
        Schema::dropIfExists('juridicax_tipos');
    }
}
