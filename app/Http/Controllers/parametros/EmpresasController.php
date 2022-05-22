<?php

namespace App\Http\Controllers\parametros;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = Empresa::where('emp_estado', '=', 1)->get();

        return response()->json($empresa);
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
            'emp_nit' => 'required',
            'emp_digito' => 'required',
            'emp_nombre' => 'required',
            'emp_direccion' => 'required',
            'emp_telefono' => 'required',
            'emp_email' => 'required',
            'sed_codigo' => 'required',
        ], [
            'emp_nit.required'  => 'Nombre es obligatorio',
            'emp_digito.required'  => 'Digito es obligatorio',
            'emp_nombre.required'  => 'Nombre es obligatorio',
            'emp_direccion.required'  => 'Direccion es obligatorio',
            'emp_telefono.required'  => 'Telefono es obligatorio',
            'emp_email.required'  => 'Emial es obligatorio',
            'sed_codigo.required'  => 'Codigo es obligatorio',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $empresa = Empresa::create($request->all());
            if ($empresa) {
                return response()->json(
                    [
                        'message' => 'Estrato registrado exitosamente!',
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
        $empresa = Empresa::findOrFail($id);
        return response()->json(['estrato' => $empresa]);
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
        $empresa = Empresa::findOrFail($id);
        $empresa = $empresa->update($request->all());

        try {
            return response()->json([
                'message' => 'Estrato eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Estrato no se actualizo exitosamente',
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
        $empresaBorrar = Empresa::findOrFail($id);
        $empresaBorrar->emp_estado = 2;
        $empresaBorrar->save();
        try {
            return response()->json([
                'message' => 'Estrato eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Estrato no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
