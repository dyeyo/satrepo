<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TipoPlanesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_planes')->insert([
            'tpa_codigo' => 10,
            'tpa_nombre' => Str::random(10),
            'tpa_descripcion' => Str::random(10),
        ]);
    }
}
