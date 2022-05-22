<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plan = Plan::with('empresas', 'tipo_planes', 'categorias')->where('pla_estado', 1)->get();
        return response()->json($plan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'pla_megas' => 'required',
            'pla_condiciones' => 'required',
            'pla_decripcion' => 'required',
            'emp_codigo' => 'required',
            'tpa_codigo' => 'required',
            'cat_codigo' => 'required',
        ], [
            'pla_megas.required'  => 'Megas es obligatorio',
            'pla_condiciones.required'  => 'condiciones es obligatorio',
            'pla_decripcion.required'  => 'decripcion es obligatorio',
            'emp_codigo.required'  => 'Codigo empresa  es obligatorio',
            'tpa_codigo.required'  => 'Codigo tipo plan es obligatorio',
            'cat_codigo.required'  => 'Codigo categoria es obligatorio',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $plan = Plan::create($request->all());
            if ($plan) {
                return response()->json(
                    [
                        'message' => 'Plan  registrado exitosamente!',
                        'code' => 200
                    ]
                );
            } else {
                return response()->json(
                    [
                        'message' => 'Error al registrar el usuario!',
                        'code' => 401
                    ]
                );
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        return response()->json(['plan' => $plan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $plan = $plan->update($request->all());

        try {
            return response()->json([
                'message' => 'Plan  eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Plan  no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $planBorrar = Plan::findOrFail($id);
        $planBorrar->pla_estado = 2;
        $planBorrar->save();
        try {
            return response()->json([
                'message' => 'Plan  eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Plan  no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
