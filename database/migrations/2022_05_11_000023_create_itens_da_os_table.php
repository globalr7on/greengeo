<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItensDaOsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_da_os', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orden_de_servicos_id');

            $table->foreign('orden_de_servicos_id')->references('id')->on('orden_de_servicos');

            $table->unsignedBigInteger('materiais_id');

            $table->foreign('materiais_id')->references('id')->on('materiais');

            $table->unsignedBigInteger('acondicionamentos_id');

            $table->foreign('acondicionamentos_id')->references('id')->on('acondicionamentos');

            $table->unsignedBigInteger('tratamentos_id');

            $table->foreign('tratamentos_id')->references('id')->on('tratamentos');

            $table->decimal('peso', $precision = 4, $scale = 2);

            $table->text('observacao_justificada', 100);

            $table->decimal('altura', $precision = 6, $scale = 2);

            $table->decimal('largura', $precision = 6, $scale = 2);

            $table->decimal('profundidade', $precision = 6, $scale = 2);

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
        Schema::dropIfExists('itens_da_os');
    }
}
