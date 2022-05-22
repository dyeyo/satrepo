<?php

namespace App\Http\Controllers\parametros;

use App\Http\Controllers\Controller;
use App\Models\Categorias;
use App\Models\TipoPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_plan = TipoPlan::where('tpa_estado', '=', 1)->get();
        return response()->json($tipo_plan);
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
            'tpa_nombre' => 'required',
            'tpa_descripcion' => 'required',
        ], [
            'tpa_nombre.required'  => 'Nombre es obligatorio',
            'tpa_descripcion.required'  => 'Departamento es obligatorio',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $tipo_plan = TipoPlan::create($request->all());
            if ($tipo_plan) {
                return response()->json(
                    [
                        'message' => 'Tipo Plan registrado exitosamente!',
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
        $tipo_plan = TipoPlan::findOrFail($id);
        return response()->json(['Tipo Plan' => $tipo_plan]);
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
        $tipo_plan = TipoPlan::findOrFail($id);
        $tipo_plan = $tipo_plan->update($request->all());

        try {
            return response()->json([
                'message' => 'Tipo Plan eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Tipo Plan no se actualizo exitosamente',
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
        $tipoPlanBorrar = TipoPlan::findOrFail($id);
        $tipoPlanBorrar->tpa_estado = 2;
        $tipoPlanBorrar->save();
        try {
            return response()->json([
                'message' => 'Tipo Plan eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Tipo Plan no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
