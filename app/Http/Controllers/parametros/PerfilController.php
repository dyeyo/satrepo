<?php

namespace App\Http\Controllers\parametros;

use App\Http\Controllers\Controller;
use App\Models\Perfiles;
use App\Models\PerfilModulo;
use App\Models\PerfilModuloPerfiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perfil = Perfiles::with('perfilModulo', 'perfilModulo.perfil', 'perfilModulo.modulo')->where('pfl_estado', '=', '1')->get();
        return response()->json($perfil);
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
            'pfl_nombre' => 'required',
            'pfl_descripcion' => 'required',
        ], [
            'pfl_nombre.required'  => 'Nombre es obligatorio',
            'pfl_descripcion.required'  => 'Descripcion es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $perfil = new Perfiles();
            $perfil->pfl_codigo = $request->pfl_codigo;
            $perfil->pfl_nombre = $request->pfl_nombre;
            $perfil->pfl_descripcion = $request->pfl_descripcion;
            $perfil->save();

            $modulos = $request->modulos;
            foreach ($modulos as $key) {
                PerfilModuloPerfiles::create(['modulos_id' => $key, 'perfiles_id' => $perfil->id]);
            }

            if ($perfil) {
                return response()->json(
                    [
                        'message' => 'Perfil registrado exitosamente!',
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
        $perfil = Perfiles::findOrFail($id);
        return response()->json(['perfil' => $perfil]);
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
        $perfil = Perfiles::findOrFail($id);
        $perfil = $perfil->update($request->all());

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perfilBorrar = Perfiles::findOrFail($id);
        $perfilBorrar->ten_estado = 2;
        $perfilBorrar->save();
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
