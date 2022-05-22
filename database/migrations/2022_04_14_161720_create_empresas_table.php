<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_codigo')->nullable();
            $table->bigInteger('emp_nit');
            $table->integer('emp_digito');
            $table->string('emp_nombre');
            $table->string('emp_direccion');
            $table->json('emp_telefono')->nullable();
            $table->json('emp_email')->nullable();
            $table->string('emp_estado')->default(1);
            $table->unsignedBigInteger('sed_codigo');
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
        Schema::dropIfExists('empresas');
    }
}
