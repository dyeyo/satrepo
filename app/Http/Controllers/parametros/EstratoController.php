<?php

namespace App\Http\Controllers\parametros;

use App\Http\Controllers\Controller;
use App\Models\Estrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estrato = Estrato::where('est_estado', '=', 1)->get();
        return response()->json($estrato);
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
            'est_nombre' => 'required',
            'est_cobro_iva' => 'required',
        ], [
            'est_nombre.required'  => 'Nombre es obligatorio',
            'est_cobro_iva.required'  => 'Departamento es obligatorio',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $estrato = Estrato::create($request->all());
            if ($estrato) {
                return response()->json(
                    [
                        'message' => 'Estrato registrado exitosamente!',
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
        $estrato = Estrato::findOrFail($id);
        return response()->json(['estrato' => $estrato]);
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
        $estrato = Estrato::findOrFail($id);
        $estrato = $estrato->update($request->all());

        try {
            return response()->json([
                'message' => 'Estrato eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Estrato no se actualizo exitosamente',
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
        $estratoBorrar = Estrato::findOrFail($id);
        $estratoBorrar->est_estado = 2;
        $estratoBorrar->save();
        try {
            return response()->json([
                'message' => 'Estrato eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Estrato no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
