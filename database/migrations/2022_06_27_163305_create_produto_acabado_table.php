<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoAcabadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_acabado', function (Blueprint $table) {
            $table->id();
            $table->string('nome_fabricante');
            $table->decimal('peso_bruto', $precision = 4, $scale = 2);
            $table->decimal('peso_liquido', $precision = 4, $scale = 2);
            $table->boolean('ativo')->default(true);
            $table->string('dimensoes');
            $table->decimal('altura', $precision = 6, $scale = 2);
            $table->decimal('largura', $precision = 6, $scale = 2);
            $table->decimal('profundidade', $precision = 6, $scale = 2);
            $table->decimal('comprimento', $precision = 6, $scale = 2);
            $table->string('especie');
            $table->string('marca');
            $table->unsignedBigInteger('pessoa_juridica_id');
            $table->foreign('pessoa_juridica_id')->references('id')->on('pessoas_juridicas');
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
        Schema::dropIfExists('produto_acabado');
    }
}
