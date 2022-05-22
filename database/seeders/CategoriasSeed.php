<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriasSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'cat_codigo' => 10,
            'cat_nombre' => Str::random(10),
            'cat_descripcion' => Str::random(10),
        ]);
    }
}
