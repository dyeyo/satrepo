<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->integer('per_codigo')->nullable();
            $table->string('per_nombre1');
            $table->string('per_nombre2');
            $table->string('per_apellido1');
            $table->string('per_apellido2');
            $table->string('per_identificacion');
            $table->string('per_email');
            $table->string('per_direccion');
            $table->json('per_telefono')->nullable();
            $table->string('per_digito');
            $table->string('per_estado')->default(1);
            $table->date('per_fecha_nacimiento');
            $table->unsignedBigInteger('est_codigo')->nullable();
            $table->unsignedBigInteger('tpe_codigo')->nullable();
            $table->unsignedBigInteger('tdo_codigo')->nullable();
            $table->unsignedBigInteger('per_mun_nacimiento')->nullable();

            $table->foreign('est_codigo')->references('id')->on('estratos');
            $table->foreign('tpe_codigo')->references('id')->on('tipo_personas');
            $table->foreign('tdo_codigo')->references('id')->on('tipo_documentos');
            $table->foreign('per_mun_nacimiento')->references('id')->on('municipios');

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
        Schema::dropIfExists('personas');
    }
}
