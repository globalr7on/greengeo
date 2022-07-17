<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDecimalColumnsNotaFiscalItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nota_fiscal_itens', function (Blueprint $table) {
            $table->float('peso', 8, 2)->change();
            $table->float('largura', 8, 2)->change();
            $table->float('profundidade', 8, 2)->change();
            $table->float('comprimento', 8, 2)->change();
            $table->float('quantidade', 8, 2)->change();
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
