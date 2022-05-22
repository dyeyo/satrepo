<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_modulo_perfiles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('perfiles_id');
            $table->unsignedBigInteger('modulos_id');

            $table->foreign('perfiles_id')->references('id')->on('perfiles');
            $table->foreign('modulos_id')->references('id')->on('modulos');

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
        Schema::dropIfExists('perfil_modulo_perfiles');
    }
}
