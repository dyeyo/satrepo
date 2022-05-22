<?php

namespace App\Http\Controllers\parametros;

use App\Http\Controllers\Controller;
use App\Models\Sedes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SedesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sede = Sedes::where('sed_estado', '=', 1)->get();
        return response()->json($sede);
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
            'sed_nombre' => 'required',
            'sed_direccion' => 'required',
            'sed_telefono' => 'required',
        ], [
            'sed_nombre.required'  => 'Nombre es obligatorio',
            'sed_direccion.required'  => 'Descripcion es obligatorio',
            'sed_telefono.required'  => 'Telefono es obligatorio',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $sede = Sedes::create($request->all());
            if ($sede) {
                return response()->json(
                    [
                        'message' => 'Sede registrado exitosamente!',
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
        $sede = Sedes::findOrFail($id);
        return response()->json(['perfil' => $sede]);
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
        $sede = Sedes::findOrFail($id);
        $sede = $sede->update($request->all());

        try {
            return response()->json([
                'message' => 'Sede eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Sede no se actualizo exitosamente',
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
        $sedeBorrar = Sedes::findOrFail($id);
        $sedeBorrar->sed_estado = 2;
        $sedeBorrar->save();
        try {
            return response()->json([
                'message' => 'Sede eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Sede no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
