<?php

namespace App\Http\Controllers;

use App\Models\EmpresaSede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpresaSedeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $empresaSede = EmpresaSede::with('sede', 'empresa', 'municipio')->where('emp_codigo', $id)->get();
        return response()->json($empresaSede);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        $empresa_sede_creada = array();
        foreach ($data as $key => $value) {
            array_push($empresa_sede_creada, array(
                'sed_codigo' => $value['sed_codigo'],
                'emp_codigo' => $value['emp_codigo'],
                'num_codigo' => $value['num_codigo'],
            ));
        }

        EmpresaSede::insert($empresa_sede_creada);

        if ($empresa_sede_creada) {
            return response()->json(
                [
                    'message' => 'Empresa sede registrado exitosamente!',
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresaSede = EmpresaSede::findOrFail($id);
        return response()->json(['empresa_sede' => $empresaSede]);
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
        EmpresaSede::findOrFail($id);

        $data = $request->all();
        $empresa_sede_creada = array();
        foreach ($data as $key => $value) {
            array_push($empresa_sede_creada, array(
                'sed_codigo' => $value['sed_codigo'],
                'emp_codigo' => $value['emp_codigo'],
                'num_codigo' => $value['num_codigo'],
            ));
        }

        EmpresaSede::insert($empresa_sede_creada);
        // $empresaSede = $empresaSede->update($request->all());

        try {
            return response()->json([
                'message' => 'Empresa sede eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Empresa sede no se actualizo exitosamente',
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
    // TODO: ESTE NO TIENE ESTADO
    public function destroy($id)
    {
        $empresaSedeBorrar = EmpresaSede::findOrFail($id);
        $empresaSedeBorrar->est_estado = 2;
        $empresaSedeBorrar->save();
        try {
            return response()->json([
                'message' => 'Empresa sede eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Empresa sede no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
