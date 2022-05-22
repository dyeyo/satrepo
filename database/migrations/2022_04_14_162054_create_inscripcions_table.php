<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripcions', function (Blueprint $table) {
            $table->id();
            $table->integer('ins_codigo')->nullable();
            $table->date('ins_fecha');
            $table->date('ins_fecha_inicio');
            $table->date('ins_fecha_fin');
            $table->string('ins_ip');
            $table->string('ins_direccion');
            $table->string('ins_estado')->default(1);

            $table->unsignedBigInteger('cli_codigo');
            $table->unsignedBigInteger('ofe_codigo');

            $table->foreign('cli_codigo')->references('id')->on('clientes');
            $table->foreign('ofe_codigo')->references('id')->on('ofertas');

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
        Schema::dropIfExists('inscripcions');
    }
}
