<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmpresaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresas')->insert([
            'emp_codigo' => 10,
            'emp_nit' => 10,
            'emp_digito' => 10,
            'emp_nombre' => Str::random(10),
            'emp_direccion' => Str::random(10),
            'sed_codigo' => 10,
        ]);
    }
}
