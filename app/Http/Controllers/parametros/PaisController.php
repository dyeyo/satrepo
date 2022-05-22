<?php

namespace App\Http\Controllers\parametros;

use App\Http\Controllers\Controller;
use App\Models\Paises;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paises = Paises::where('pai_estado', '=', 1)->get();
        return response()->json(
            $paises
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
            'pai_nombre' => 'required',
        ], [
            'pai_nombre.required'  => 'Nombre es obligatorio',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $pais = Paises::create($request->all());

            if ($pais) {
                return response()->json(
                    [
                        'message' => 'Pais registrado exitosamente!',
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
        $tpais = Paises::findOrFail($id);
        return response()->json(['pais' => $tpais]);
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
        $tpais = Paises::findOrFail($id);
        $paisUp = $tpais->update($request->all());

        try {
            return response()->json([
                'message' => 'Pais actualizado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Pais no se actualizo exitosamente',
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
        $pais = Paises::findOrFail($id);
        $pais->pai_estado = 2;
        $pais->save();

        try {
            return response()->json([
                'message' => 'Pais eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Pais no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
