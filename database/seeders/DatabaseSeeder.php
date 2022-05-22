<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriasSeed::class);
        $this->call(EmpresaSeed::class);
        $this->call(EstadoSeed::class);
        $this->call(EstratoSeed::class);
        $this->call(FormaPagoSeed::class);
        $this->call(ModuloSeed::class);
        $this->call(PeriodoSeed::class);
        $this->call(SedesSeed::class);
        $this->call(TipoDocumentoSeed::class);
        $this->call(TipoEntrgaSeed::class);
        $this->call(TipoPlanesSeed::class);
    }
}
