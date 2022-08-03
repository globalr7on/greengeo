<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeIbamasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ibamas', function (Blueprint $table) {
            $table->string('codigo', 10)->change();
            $table->text('denominacao')->change();
            $table->unsignedBigInteger('classe_sucata_id');
            $table->foreign('classe_sucata_id')->references('id')->on('classe_sucatas');
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
