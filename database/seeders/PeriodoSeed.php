<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PeriodoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('periodos')->insert([
            'prd_codigo' => 10,
            'prd_nombre' => Str::random(10),
            'prd_descripcion' => Str::random(10),
        ]);
    }
}
