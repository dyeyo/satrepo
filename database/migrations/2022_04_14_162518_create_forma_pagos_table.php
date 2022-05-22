<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormaPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forma_pagos', function (Blueprint $table) {
            $table->id();
            $table->integer('fpa_codigo')->nullable();
            $table->string('fpa_nombre');
            $table->string('fpa_descripcion');
            $table->string('fpa_estado')->default(1);
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
        Schema::dropIfExists('forma_pagos');
    }
}
