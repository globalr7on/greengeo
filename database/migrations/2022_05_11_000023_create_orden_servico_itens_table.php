<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenServicoItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_servico_itens', function (Blueprint $table) {
            $table->id();
            $table->decimal('peso', $precision = 4, $scale = 2);
            $table->text('observacao_justificada', 100);
            $table->decimal('altura', $precision = 6, $scale = 2);
            $table->decimal('largura', $precision = 6, $scale = 2);
            $table->decimal('profundidade', $precision = 6, $scale = 2);
            $table->unsignedBigInteger('orden_servico_id');
            $table->foreign('orden_servico_id')->references('id')->on('ordens_servicos');
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('materiais');
            $table->unsignedBigInteger('acondicionamento_id');
            $table->foreign('acondicionamento_id')->references('id')->on('acondicionamentos');
            $table->unsignedBigInteger('tratamento_id');
            $table->foreign('tratamento_id')->references('id')->on('tratamentos');
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
        Schema::dropIfExists('orden_servico_itens');
    }
}
