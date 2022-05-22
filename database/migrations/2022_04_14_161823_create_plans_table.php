<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->id();
            $table->integer('pla_codigo')->nullable();
            $table->integer('pla_megas');
            $table->integer('pla_condiciones');
            $table->string('pla_decripcion');
            $table->string('pla_estado')->default(1);

            $table->unsignedBigInteger('emp_codigo');
            $table->unsignedBigInteger('tpa_codigo');
            $table->unsignedBigInteger('cat_codigo');

            $table->foreign('emp_codigo')->references('id')->on('empresas');
            $table->foreign('tpa_codigo')->references('id')->on('tipo_planes');
            $table->foreign('cat_codigo')->references('id')->on('categorias');

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
        Schema::dropIfExists('planes');
    }
}
