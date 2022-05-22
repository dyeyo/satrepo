<?php

namespace App\Http\Controllers\parametros;

use App\Http\Controllers\Controller;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pediodo = Periodo::where('prd_estado', '=', 1)->get();
        return response()->json($pediodo);
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
            'prd_nombre' => 'required',
            'prd_descripcion' => 'required'
        ], [
            'prd_nombre.required'  => 'Nombre es obligatorio',
            'prd_descripcion.required'  => 'Descripcion es obligatorio'
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $pediodo = Periodo::create($request->all());
            if ($pediodo) {
                return response()->json(
                    [
                        'message' => 'Periodo registrado exitosamente!',
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
        $pediodo = Periodo::findOrFail($id);
        return response()->json(['estrato' => $pediodo]);
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
        $pediodo = Periodo::findOrFail($id);
        $pediodo = $pediodo->update($request->all());

        try {
            return response()->json([
                'message' => 'Periodo eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Periodo no se actualizo exitosamente',
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
        $periodoBorrar = Periodo::findOrFail($id);
        $periodoBorrar->prd_estado = 2;
        $periodoBorrar->save();
        try {
            return response()->json([
                'message' => 'Periodo eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Periodo no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
