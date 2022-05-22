<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TipoEntrgaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_entregas')->insert([
            'ten_codigo' => 10,
            'ten_nombre' => Str::random(10),
            'ten_descripcion' => Str::random(10),
        ]);
    }
}
