<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ModuloSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modulos')->insert([
            'mod_codigo' => 10,
            'mod_nombre' => Str::random(10),
            'mod_descripcion' => Str::random(10),
        ]);
    }
}
