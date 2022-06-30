<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasJuridicasExtraFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pessoas_juridicas', function (Blueprint $table) {
            
            $table->unsignedBigInteger('tipo_empresa_id')->nullable();
            $table->foreign('tipo_empresa_id')->references('id')->on('tipo_empresa');
          
        });
    }

    // /**
    //  * Reverse the migrations.
    //  *
    //  * @return void
    //  */
    // public function down()
    // {
    //     Schema::dropIfExists('users_extra_fields');
    // }
}
