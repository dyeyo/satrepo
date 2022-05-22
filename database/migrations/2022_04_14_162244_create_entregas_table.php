<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->integer('ent_codigo')->nullable();
            $table->date('ent_fecha_entrega');
            $table->string('ent_equipo_entregado');
            $table->string('ent_cable_drop');
            $table->string('ent_id');
            $table->string('ent_mb');
            $table->string('ent_referencia_router');
            $table->string('ent_access_point');
            $table->string('ent_cable_utp');
            $table->string('ent_referencia_antena');
            $table->string('ent_setado');

            $table->unsignedBigInteger('tec_codigo');
            $table->unsignedBigInteger('ten_codigo');
            $table->unsignedBigInteger('ins_codigo');

            $table->foreign('tec_codigo')->references('id')->on('tipo_entregas');
            $table->foreign('ten_codigo')->references('id')->on('tecnicos');
            $table->foreign('ins_codigo')->references('id')->on('inscripcions');

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
        Schema::dropIfExists('entregas');
    }
}
