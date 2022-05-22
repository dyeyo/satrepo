<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InscripcionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inscripcion = Inscripcion::with('cliente', 'oferta')->where('ins_estado', 1)->get();
        return response()->json($inscripcion);
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
            'ins_fecha' => 'required',
            'ins_fecha_inicio' => 'required',
            'ins_fecha_fin' => 'required',
            'ins_ip' => 'required',
            'ins_direccion' => 'required',
            'cli_codigo' => 'required',
            'ofe_codigo' => 'required',
        ], [
            'ins_fecha.required'  => 'Fecha es obligatorio',
            'ins_fecha_inicio.required'  => 'Fecha inicio es obligatorio',
            'ins_fecha_fin.required'  => 'Fecha fin es obligatorio',
            'ins_ip.required'  => 'IP es obligatorio',
            'ins_direccion.required'  => 'Dirección  es obligatorio',
            'cli_codigo.required'  => 'Cliente  es obligatorio',
            'ofe_codigo.required'  => 'Oferta es obligatorio',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $inscripcion = Inscripcion::create($request->all());
            if ($inscripcion) {
                return response()->json(
                    [
                        'message' => 'Inscripcion registrado exitosamente!',
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
        $inscripcion = Inscripcion::findOrFail($id);
        return response()->json(['plan' => $inscripcion]);
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
        $inscripcion = Inscripcion::findOrFail($id);
        $inscripcion = $inscripcion->update($request->all());

        try {
            return response()->json([
                'message' => 'Inscripcion eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Inscripcion no se actualizo exitosamente',
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
        $inscripcionBorrar = Inscripcion::findOrFail($id);
        $inscripcionBorrar->ins_estado = 2;
        $inscripcionBorrar->save();
        try {
            return response()->json([
                'message' => 'Inscripcion eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Inscripcion no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
