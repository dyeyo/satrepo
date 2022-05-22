<?php

namespace App\Http\Controllers\parametros;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::where('dep_estado', '=', 1)->get();
        return response()->json(
            $departamentos

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
            'dep_nombre' => 'required',
            'pai_codigo' => 'required',
        ], [
            'dep_codigo.unique'  => 'Codigo ya existe',
            'dep_nombre.required'  => 'Nombre es obligatorio',
            'pai_codigo.required'  => 'Pais es obligatorio',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $departamento = Departamento::create($request->all());

            if ($departamento) {
                return response()->json(
                    [
                        'message' => 'departamento registrado exitosamente!',
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
        $tdepartamento = Departamento::findOrFail($id);
        return response()->json(['departamento' => $tdepartamento]);
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
        $tdepartamento = Departamento::findOrFail($id);
        $departamentoUp = $tdepartamento->update($request->all());

        try {
            return response()->json([
                'message' => 'departamento eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'departamento no se actualizo exitosamente',
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
        $deparBorrar = Departamento::findOrFail($id);
        $deparBorrar->mun_estado = 2;
        $deparBorrar->save();
        try {
            return response()->json([
                'message' => 'departamento eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'departamento no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }

    public function getDepartamentosByPais($id)
    {
        $departamentosPais = Departamento::where('pai_codigo', $id)->get();
        return response()->json(['departamentos' => $departamentosPais]);
    }
}
