<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SedesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sedes')->insert([
            'sed_codigo' => 10,
            'sed_nombre' => Str::random(10),
            'sed_direccion' => Str::random(10),
        ]);
    }
}
