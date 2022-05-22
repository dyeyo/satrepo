<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Inscripciones extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('liquidacions')->insert([
            'ins_fecha' => Str::random('2022-05-30'),
            'ins_fecha_inicio' => Str::random('2022-05-30'),
            'ins_fecha_fin' =>  Str::random('2022-05-30'),
            'ins_ip' => 11111,
            'ins_direccion' => Str::random('calle 4'),
            'cli_codigo' => 1,
            'ofe_codigo' => 1,
        ]);
    }
}
