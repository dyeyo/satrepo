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
use Illuminate\Support\Facades\Log;

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
        $hoy = Carbon::now();

        $perido = Periodo::where('prd_codigo', $hoy->month)->first();

        if ($perido) {
            $inicio = $hoy->startOfMonth()->toDateString();
            $fin = $hoy->endOfMonth()->toDateString();

            $estado = Estado::first();
            $inscripciones = Inscripcion::with('oferta')->whereBetween('ins_fecha', [$inicio, $fin])->get();

            foreach ($inscripciones as $inscripcion) {

                // $data = User::select('users.nameUser', 'categories.nameCategory')
                //     ->join('categories', 'users.idUser', '=', 'categories.user_id')
                //     ->get();

                // El metodo firstOrCreate hace la consulta de si ya existe el registro con la condición del primer arreglo
                // en caso de que exista solo hace la consulta, en caso de que no existe lo crea con los datos del segundo arreglo
                $liquidacion = Liquidacion::firstOrCreate([
                    'ins_codigo' => $inscripcion->id,
                    'prod_codigo' => $perido->id,
                ], [
                    'liq_codigo' => null,
                    'liq_dias' => (30 - $hoy->day) + 1,
                    'liq_valor' => $inscripcion->oferta->ofe_valor,
                    'tipo_creacion' => 1,
                    'est_codigo' => $estado->id,
                ]);
                // Con esto puedes ver en el log (laravel.log) si esta consultado o creando con el valor wasRecentlyCreated
                Log::debug($liquidacion);
                Log::debug('Was recentyle created: ' . $liquidacion->wasRecentlyCreated);

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

                // } else {
                //     return;
                // }
            }
        }
    }
}
