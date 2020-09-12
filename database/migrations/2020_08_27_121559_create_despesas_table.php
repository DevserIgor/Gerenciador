<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->id();
            $table->timestamp('data_cadastro');
            $table->unsignedBigInteger('tipo_despesa_id');
            $table->float('valor');
            $table->string('historico');
            $table->unsignedBigInteger('empresa_id');

            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('tipo_despesa_id')->references('id')->on('tipos_despesas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('despesas');
    }
}
