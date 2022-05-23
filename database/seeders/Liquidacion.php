<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Liquidacion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('liquidacions')->insert([
            'liq_liq_dias' => 10,
            'ins_liq_valor' => 1000,
            'prodins_codigo' => 1,
            'est_prod_codigo' => 1,
            'est_est_codigo' => 1,
        ]);
    }
}
