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
            // $table->dropColumn(['dimensoes']);
            $table->string('ean')->nullable()->change();
            $table->float('altura')->nullable()->change();
            $table->float('largura')->nullable()->change();
            $table->float('profundidade')->nullable()->change();
            $table->float('comprimento')->nullable()->change();
            $table->string('especie')->nullable()->change();
            $table->string('marca')->nullable()->change();
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
