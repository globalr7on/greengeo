<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProdutoAcabadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produto_acabado', function (Blueprint $table) {
            $table->dropColumn(['nota_fiscal_item_id']);
            $table->string('ean')->nullable()->change();
            $table->double('altura')->nullable()->change();
            $table->double('largura')->nullable()->change();
            $table->double('profundidade')->nullable()->change();
            $table->double('comprimento')->nullable()->change();
            $table->double('especie')->nullable()->change();
            $table->double('marca')->nullable()->change();
            $table->boolean('ativo')->default(true);
            $table->unsignedBigInteger('pessoa_juridica_id');
            $table->foreign('pessoa_juridica_id')->references('id')->on('pessoas_juridicas');
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
