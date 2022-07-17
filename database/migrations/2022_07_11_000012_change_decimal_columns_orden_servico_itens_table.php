<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDecimalColumnsOrdenServicoItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orden_servico_itens', function (Blueprint $table) {
            $table->float('peso', 4, 2)->change();
            $table->float('altura', 6, 2)->change();
            $table->float('largura', 6, 2)->change();
            $table->float('profundidade', 6, 2)->change();
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
