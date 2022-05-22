<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->integer('pag_codigo')->nullable();
            $table->date('pag_fecha');
            $table->float('pag_valor');
            $table->string('pag_estado')->default(1);

            $table->unsignedBigInteger('liq_codigo');
            $table->unsignedBigInteger('usu_codigo');
            $table->unsignedBigInteger('fpa_codigo');

            $table->foreign('liq_codigo')->references('id')->on('liquidacions');
            $table->foreign('usu_codigo')->references('id')->on('usuarios');
            $table->foreign('fpa_codigo')->references('id')->on('forma_pagos');

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
        Schema::dropIfExists('pagos');
    }
}
