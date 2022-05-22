<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class TipoPersonaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_personas')->insert([
            'tpe_codigo' => 10,
            'tpe_nombre' => Str::random(10),
        ]);
    }
}
