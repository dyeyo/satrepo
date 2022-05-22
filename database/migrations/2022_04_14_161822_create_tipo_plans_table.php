<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_planes', function (Blueprint $table) {
            $table->id();
            $table->integer('tpa_codigo')->nullable();
            $table->string('tpa_nombre');
            $table->string('tpa_descripcion');
            $table->string('tpa_estado')->default(1);
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
        Schema::dropIfExists('tipo_planes');
    }
}
