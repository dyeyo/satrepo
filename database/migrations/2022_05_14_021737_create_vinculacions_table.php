<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVinculacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vinculaciones', function (Blueprint $table) {
            $table->id();

            $table->date('vin_fecha_inicio');
            $table->date('vin_fecha_fin');
            $table->string('vin_estado')->default(1);


            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('empresa_sede_id');

            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('empresa_sede_id')->references('id')->on('empresa_sedes');


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
        Schema::dropIfExists('vinculaciones');
    }
}
