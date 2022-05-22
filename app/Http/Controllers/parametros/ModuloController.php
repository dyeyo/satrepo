<?php

namespace App\Http\Controllers\parametros;

use App\Http\Controllers\Controller;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulo = Modulo::where('mod_estado', '=', 1)->get();
        return response()->json(
            $modulo

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
            'mod_nombre' => 'required',
            'mod_descripcion' => 'required',
        ], [
            'mod_nombre.required'  => 'Nombre es obligatorio',
            'mod_descripcion.required'  => 'Descripcion es obligatorio',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $modulo = Modulo::create($request->all());
            if ($modulo) {
                return response()->json(
                    [
                        'message' => 'Modulo registrado exitosamente!',
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
        $modulo = Modulo::findOrFail($id);
        return response()->json(['modulo' => $modulo]);
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
        $modulo = Modulo::findOrFail($id);
        $modulo = $modulo->update($request->all());

        try {
            return response()->json([
                'message' => 'Modulo eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Modulo no se actualizo exitosamente',
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
        $moduloBorrar = Modulo::findOrFail($id);
        $moduloBorrar->mod_estado = 2;
        $moduloBorrar->save();
        try {
            return response()->json([
                'message' => 'Perfil eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Perfil no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
