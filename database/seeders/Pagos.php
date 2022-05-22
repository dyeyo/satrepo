<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Pagos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('periodos')->insert([
            'pag_fecha' => Str::random('2022-05-30'),
            'pag_valor' => 10,
            'liq_codigo' => 1,
            'usu_codigo' => 1,
            'fpa_codigo' => 1,
        ]);
    }
}
