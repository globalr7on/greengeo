<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNullOrdensServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordens_servicos', function (Blueprint $table) {
            $table->dropColumn(['mtr', 'serie', 'cdf_serial', 'cdf_ano']);
            $table->string('codigo', 15)->nullable()->change();
            $table->date('data_estagio')->nullable()->change();
            $table->renameColumn('emissao', 'data_emissao')->nullable()->change();
            $table->renameColumn('preenchimento', 'data_preenchimento')->nullable()->change();
            $table->renameColumn('integracao', 'data_integracao')->nullable()->change();
            $table->renameColumn('peso_de_controle', 'peso_controle')->nullable()->change();
            $table->date('data_inicio_coleta');
            $table->date('data_final_coleta');
            $table->unsignedBigInteger('acondicionamento_id');
            $table->foreign('acondicionamento_id')->references('id')->on('acondicionamentos');
            $table->unsignedBigInteger('responsavel_id');
            $table->foreign('responsavel_id')->references('id')->on('users');
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
