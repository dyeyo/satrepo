<?php

namespace App\Jobs;

use App\Models\Estado;
use App\Models\FormaPago;
use App\Models\Inscripcion;
use App\Models\Liquidacion;
use App\Models\Pago;
use App\Models\Periodo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SettlementJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $periodos = Periodo::all();
        $hoy = Carbon::now();

        $inicio = $hoy->year . '-' . $hoy->month . '-01';
        $fin = $hoy->year . '-' . $hoy->month . '-30';

        $inscripciones = Inscripcion::with('oferta')->whereBetween('ins_fecha', [$inicio, $fin])->get();
        $estado = Estado::first();
        $perido = Periodo::where('id', $hoy->month)->first();

        if($perido) {
            foreach($inscripciones as $inscripcion) {

                $liquidacion = Liquidacion::create([
                    'liq_codigo' => null,
                    'liq_dias' => (30 - $hoy->day) + 1,
                    'liq_valor' => $inscripcion->oferta->ofe_valor,
                    'ins_codigo' => $inscripcion->id,
                    'prod_codigo' => $perido->id,
                    'est_codigo' => $estado->id,
                ]);
            }
        }

    }
}
