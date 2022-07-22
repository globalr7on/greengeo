<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsProdutoSegregadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('produto_segregados', function (Blueprint $table) {
            $table->float('peso_bruto', 8, 2)->change();
            $table->float('peso_liquido', 8, 2)->change();
            $table->float('percentual_composicao', 8, 2)->change();
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
    }
}
