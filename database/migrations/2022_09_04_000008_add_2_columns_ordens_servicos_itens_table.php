<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add2ColumnsOrdensServicosItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orden_servico_itens', function (Blueprint $table) {
            $table->dropColumn(['peso_bruto']);
            $table->float('peso_controle_transportador', 8, 2);
            $table->float('peso_controle_destinador', 8, 2);
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
