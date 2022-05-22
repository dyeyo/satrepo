<?php

namespace App\Http\Controllers\parametros;

use App\Http\Controllers\Controller;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoDocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_documento = TipoDocumento::where('tdo_estado', '=', 1)->get();
        return response()->json(
            $tipo_documento

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
            'tdo_nombre' => 'required',
        ], [
            'tdo_nombre.required'  => 'Nombre es obligatorio',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $tipo_documento = TipoDocumento::create($request->all());
            if ($tipo_documento) {
                return response()->json(
                    [
                        'message' => 'Tipo documento registrado exitosamente!',
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
        $tipo_documento = TipoDocumento::findOrFail($id);
        return response()->json(['Tipo documento' => $tipo_documento]);
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
        $tipo_documento = TipoDocumento::findOrFail($id);
        $tipo_documento = $tipo_documento->update($request->all());

        try {
            return response()->json([
                'message' => 'Tipo documento eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Tipo documento no se actualizo exitosamente',
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
        $tipoDocumentoBorrar = TipoDocumento::findOrFail($id);
        $tipoDocumentoBorrar->ten_estado = 2;
        $tipoDocumentoBorrar->save();
        try {
            return response()->json([
                'message' => 'Tipo documento eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Tipo documento no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
