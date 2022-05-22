<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FormaPagoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forma_pagos')->insert([
            'fpa_codigo' => 10,
            'fpa_nombre' => Str::random(10),
            'fpa_descripcion' => Str::random(10),
        ]);
    }
}
