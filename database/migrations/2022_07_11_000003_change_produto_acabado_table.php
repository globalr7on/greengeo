<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeProdutoAcabadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produto_acabado', function (Blueprint $table) {
            $table->dropColumn(['nome_fabricante','peso_bruto', 'peso_liquido']);
            $table->float('altura', 6, 2)->change();
            $table->float('largura', 6, 2)->change();
            $table->float('profundidade', 6, 2)->change();
            $table->float('comprimento', 6, 2)->change();
            $table->string('ean');
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
