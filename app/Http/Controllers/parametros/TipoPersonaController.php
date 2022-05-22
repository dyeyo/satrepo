<?php

namespace App\Http\Controllers\parametros;

use App\Http\Controllers\Controller;
use App\Models\TipoPersona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoPersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_persona = TipoPersona::where('tpe_estado', '=', 1)->get();
        return response()->json(
            $tipo_persona,

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
            'tpe_nombre' => 'required',
        ], [
            'tpe_nombre.required'  => 'Nombre es obligatorio',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $tipo_persona = TipoPersona::create($request->all());
            if ($tipo_persona) {
                return response()->json(
                    [
                        'message' => 'Tipo persona registrado exitosamente!',
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
        $tipo_persona = TipoPersona::findOrFail($id);
        return response()->json(['tipo_persona' => $tipo_persona]);
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
        $tipo_persona = TipoPersona::findOrFail($id);
        $tipo_persona = $tipo_persona->update($request->all());

        try {
            return response()->json([
                'message' => 'Tipo persona eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Tipo persona no se actualizo exitosamente',
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
        $tipoPersonaBorrar = TipoPersona::findOrFail($id);
        $tipoPersonaBorrar->tpe_estado = 2;
        $tipoPersonaBorrar->save();
        try {
            return response()->json([
                'message' => 'Tipo persona eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Tipo persona no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
