<?php

namespace App\Http\Controllers;

use App\Models\Vinculaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VinculacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $vinculacion = Vinculaciones::with('usuario_id', 'empresa_sede_id')
            ->where('vin_estado', 1)
            ->where('usuario_id', $id)
            ->get();

        return response()->json($vinculacion);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $vinculacion = array();
        foreach ($data as $key => $value) {
            array_push($vinculacion, array(
                'vin_fecha_inicio' => $value['vin_fecha_inicio'],
                'vin_fecha_fin' => $value['vin_fecha_fin'],
                'usuario_id' => $value['usuario_id'],
                'empresa_sede_id' => $value['empresa_sede_id'],
            ));
        }

        Vinculaciones::insert($vinculacion);
        if ($vinculacion) {
            return response()->json(
                [
                    'message' => 'Vinculacion registrado exitosamente!',
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
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vinculacion = Vinculaciones::findOrFail($id);
        return response()->json(['plan' => $vinculacion]);
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
        $vinculacion = Vinculaciones::findOrFail($id);
        $vinculacion = $vinculacion->update($request->all());

        try {
            return response()->json([
                'message' => 'Vinculacion eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Vinculacion no se actualizo exitosamente',
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
        $vinculacionBorrar = Vinculaciones::findOrFail($id);
        $vinculacionBorrar->pla_estado = 2;
        $vinculacionBorrar->save();
        try {
            return response()->json([
                'message' => 'Vinculacion eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Vinculacion no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
