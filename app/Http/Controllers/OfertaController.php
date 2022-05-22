<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oferta = Oferta::with('empresaSede', 'plan')->where('ofe_estado', 1)->get();
        return response()->json($oferta);
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
            'ofe_valor' => 'required',
            'ofe_fecha' => 'required',
            'ese_codigo' => 'required',
        ], [
            'ofe_valor.required'  => 'Valor es obligatorio',
            'ofe_fecha.required'  => 'Fecha es obligatorio',
            'ese_codigo.required'  => 'Emperesa sede  es obligatorio',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $oferta = Oferta::create($request->all());
            if ($oferta) {
                return response()->json(
                    [
                        'message' => 'Oferta registrado exitosamente!',
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
        $oferta = Oferta::findOrFail($id);
        return response()->json(['oferta' => $oferta]);
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
        $oferta = Oferta::findOrFail($id);
        $oferta = $oferta->update($request->all());

        try {
            return response()->json([
                'message' => 'Oferta eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Oferta no se actualizo exitosamente',
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
        $ofertaBorrar = Oferta::findOrFail($id);
        $ofertaBorrar->ofe_estado = 2;
        $ofertaBorrar->save();
        try {
            return response()->json([
                'message' => 'Oferta eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Oferta no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
