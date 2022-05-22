<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();
            $table->integer('ofe_codigo')->nullable();
            $table->string('ofe_valor');
            $table->string('ofe_fecha');
            $table->string('ofe_estado')->default(1);

            $table->unsignedBigInteger('pla_codigo');
            $table->unsignedBigInteger('mun_codigo');
            $table->unsignedBigInteger('ese_codigo');

            $table->foreign('pla_codigo')->references('id')->on('planes');
            // TODO: PREGUINTAR QUE ES MUN CODIGO, EN LA BASE DE DATOS NO TIENE RELACCION CON MUNICIPIO
            $table->foreign('mun_codigo')->references('id')->on('tipo_planes');
            $table->foreign('ese_codigo')->references('id')->on('empresa_sedes');

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
        Schema::dropIfExists('ofertas');
    }
}
