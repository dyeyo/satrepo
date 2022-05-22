<?php

namespace App\Http\Controllers\parametros;

use App\Http\Controllers\Controller;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipios = Municipio::where('mun_estado', '=', 1)->get();
        return response()->json(
            $municipios
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
            'mun_nombre' => 'required',
            'dep_codigo' => 'required',
        ], [
            'mun_nombre.required'  => 'Nombre es obligatorio',
            'dep_codigo.required'  => 'Departamento es obligatorio',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $municipio = Municipio::create($request->all());
            if ($municipio) {
                return response()->json(
                    [
                        'message' => 'Municipio registrado exitosamente!',
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
        $tmunicipio = Municipio::findOrFail($id);
        return response()->json(['Municipio' => $tmunicipio]);
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
        $tmunicipio = Municipio::findOrFail($id);
        $municipioUp = $tmunicipio->update($request->all());

        try {
            return response()->json([
                'message' => 'Municipio eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Municipio no se actualizo exitosamente',
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
        $munipioBorrar = Municipio::findOrFail($id);
        $munipioBorrar->mun_estado = 2;
        $munipioBorrar->save();
        try {
            return response()->json([
                'message' => 'Municipio eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Municipio no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }

    public function getMuniByDepar($id)
    {
        $minuDep = Municipio::where('dep_codigo', $id)->get();
        return response()->json(['municipios' => $minuDep]);
    }
}
