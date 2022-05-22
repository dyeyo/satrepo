<?php

namespace App\Http\Controllers\parametros;

use App\Http\Controllers\Controller;
use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoria = Categorias::where('cat_estado', '=', 1)->get();
        return response()->json($categoria);
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
            'cat_nombre' => 'required',
            'cat_descripcion' => 'required',
        ], [
            'cat_codigo.unique'  => 'Codigo ya existe',
            'cat_nombre.required'  => 'Nombre es obligatorio',
            'cat_descripcion.required'  => 'Departamento es obligatorio',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'errors' => $validator->errors()
                ]
            );
        } else {
            $categoria = Categorias::create($request->all());
            if ($categoria) {
                return response()->json(
                    [
                        'message' => 'Categoria registrado exitosamente!',
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
        $categoria = Categorias::findOrFail($id);
        return response()->json(['Categoria' => $categoria]);
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
        $categoria = Categorias::findOrFail($id);
        $categoriaUp = $categoria->update($request->all());

        try {
            return response()->json([
                'message' => 'Categoria eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Categoria no se actualizo exitosamente',
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
        $munipioBorrar = Categorias::findOrFail($id);
        $munipioBorrar->cat_estado = 2;
        $munipioBorrar->save();
        try {
            return response()->json([
                'message' => 'Categoria eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Categoria no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
