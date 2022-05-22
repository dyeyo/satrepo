<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_sedes', function (Blueprint $table) {
            $table->id();
            $table->integer('ese_codigo')->nullable();
            $table->unsignedBigInteger('sed_codigo');
            $table->unsignedBigInteger('emp_codigo');
            $table->unsignedBigInteger('num_codigo');

            $table->foreign('sed_codigo')->references('id')->on('sedes');
            $table->foreign('emp_codigo')->references('id')->on('empresas');
            $table->foreign('num_codigo')->references('id')->on('municipios');
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
        Schema::dropIfExists('empresa_sedes');
    }
}
