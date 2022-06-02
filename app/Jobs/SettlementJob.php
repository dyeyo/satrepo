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
        $perido = Periodo::where('prd_codigo', $hoy->month + 1)->first();

        if ($perido) {
            foreach ($inscripciones as $inscripcion) {

                $data = User::select('users.nameUser', 'categories.nameCategory')
                    ->join('categories', 'users.idUser', '=', 'categories.user_id')
                    ->get();


                // $liquidacionExiste = Liquidacion::select(
                //     'liquidacions.liq_codigo',
                //     'liquidacions.liq_dias',
                //     'liquidacions.liq_valor',
                //     'liquidacions.tipo_creacion',
                //     'inscripcions.ins_codigo',
                //     'inscripcions.ins_fecha',
                //     'inscripcions.ins_fecha_inicio',
                //     'inscripcions.ins_fecha_fin',
                //     'inscripcions.ins_ip',
                //     'inscripcions.ins_estado',
                //     'inscripcions.ins_direccion'
                // )
                //     ->join('inscripcions', 'liquidacions.ins_codigo', '=', 'inscripcions.id')
                //     ->where('inscripcions.ins_fecha_fin', '>',)->get();
                // ins_fecha_inicio
                // $liquidacionExiste = Liquidacion::where('ins_codigo', $inscripcion->id)->where('prod_codigo', $perido->id)->count();
                // if ($liquidacionExiste < 0) {
                $liquidacion = Liquidacion::create([
                    'liq_codigo' => null,
                    'liq_dias' => (30 - $hoy->day) + 1,
                    'liq_valor' => $inscripcion->oferta->ofe_valor,
                    'ins_codigo' => $inscripcion->id,
                    'tipo_creacion' => 1,
                    'prod_codigo' => $perido->id,
                    'est_codigo' => $estado->id,
                ]);
                // } else {
                //     return;
                // }
            }
        }
    }
}
