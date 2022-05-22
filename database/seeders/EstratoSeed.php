<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EstratoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estratos')->insert([
            'est_codigo' => 10,
            'est_nombre' => Str::random(10),
            'est_cobro_iva' => true,
        ]);
    }
}
