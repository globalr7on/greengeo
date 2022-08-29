<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdensServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordens_servicos', function (Blueprint $table) {
            $table->dropForeign('ordens_servicos_nota_fiscal_id_foreign');
            $table->dropColumn(['nota_fiscal_id', 'peso_total_os', 'area_total']);
            $table->integer('cdf_serial')->nullable()->change();
            $table->integer('cdf_ano')->nullable()->change();
            $table->float('peso_de_controle')->nullable()->change();
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
