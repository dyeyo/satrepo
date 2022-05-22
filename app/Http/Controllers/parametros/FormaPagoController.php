<?php

namespace App\Http\Controllers\parametros;

use App\Http\Controllers\Controller;
use App\Models\FormaPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormaPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forma_pagos = FormaPago::where('fpa_estado', '=', 1)->get();
        return response()->json(
            $forma_pagos

        );
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
            'fpa_nombre' => 'required',
            'fpa_descripcion' => 'required',
        ], [
            'fpa_nombre.required'  => 'Nombre es obligatorio',
            'fpa_descripcion.required'  => 'Departamento es obligatorio',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $forma_pago = FormaPago::create($request->all());
            if ($forma_pago) {
                return response()->json(
                    [
                        'message' => 'Forma de pago registrado exitosamente!',
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
        $forma_pago = FormaPago::findOrFail($id);
        return response()->json(['Forma de pago' => $forma_pago]);
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
        $forma_pago = FormaPago::findOrFail($id);
        $forma_pagoUp = $forma_pago->update($request->all());

        try {
            return response()->json([
                'message' => 'Forma de pago eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Forma de pago no se actualizo exitosamente',
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
        $formaPagoBorrar = FormaPago::findOrFail($id);
        $formaPagoBorrar->fpa_estado = 2;
        $formaPagoBorrar->save();
        try {
            return response()->json([
                'message' => 'Forma de pago eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Forma de pago no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
