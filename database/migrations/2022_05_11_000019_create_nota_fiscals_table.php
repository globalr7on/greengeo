<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaFiscalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_fiscals', function (Blueprint $table) {
            $table->id();
            $table->string('numero_total', 10);
            $table->string('serie', 2);
            $table->integer('folha');
            $table->string('chave_de_acesso', 45);

            $table->unsignedBigInteger('pessoa_juridicas_id');

            $table->foreign('pessoa_juridicas_id')->references('id')->on('pessoa_juridicas');

            
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
        Schema::dropIfExists('nota_fiscals');
    }
}
