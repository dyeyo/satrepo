<?php

namespace App\Http\Controllers\parametros;

use App\Http\Controllers\Controller;
use App\Models\Categorias;
use App\Models\TipoEntrega;
use App\Models\TipoPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoEntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_entrega = TipoEntrega::where('ten_estado', '=', 1)->get();
        return response()->json(
            $tipo_entrega,

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
            'ten_nombre' => 'required',
            'ten_descripcion' => 'required',
        ], [
            'ten_nombre.required'  => 'Nombre es obligatorio',
            'ten_descripcion.required'  => 'Departamento es obligatorio',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $tipo_entrega = TipoEntrega::create($request->all());
            if ($tipo_entrega) {
                return response()->json(
                    [
                        'message' => 'Tipo entrega registrado exitosamente!',
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
        $tipo_entrega = TipoEntrega::findOrFail($id);
        return response()->json(['Tipo entrega' => $tipo_entrega]);
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
        $tipo_entrega = TipoEntrega::findOrFail($id);
        $tipo_entrega = $tipo_entrega->update($request->all());

        try {
            return response()->json([
                'message' => 'Tipo entrega eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Tipo entrega no se actualizo exitosamente',
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
        $tipoEntregaBorrar = TipoEntrega::findOrFail($id);
        $tipoEntregaBorrar->ten_estado = 2;
        $tipoEntregaBorrar->save();
        try {
            return response()->json([
                'message' => 'Tipo entrega eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Tipo entrega no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
