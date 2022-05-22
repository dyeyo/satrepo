<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquidacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidacions', function (Blueprint $table) {
            $table->id();
            $table->integer('liq_codigo')->nullable();
            $table->integer('liq_dias');
            $table->integer('liq_valor');

            $table->unsignedBigInteger('ins_codigo');
            $table->unsignedBigInteger('prod_codigo');
            $table->unsignedBigInteger('est_codigo');

            $table->foreign('ins_codigo')->references('id')->on('inscripcions');
            $table->foreign('prod_codigo')->references('id')->on('periodos');
            $table->foreign('est_codigo')->references('id')->on('estados');

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
        Schema::dropIfExists('liquidacions');
    }
}
