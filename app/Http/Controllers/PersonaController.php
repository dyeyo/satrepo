<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\PerfilModuloPerfiles;
use App\Models\Persona;
use App\Models\Tecnico;
use App\Models\Usuario;
use App\Models\UsuarioPerfilModulo;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::with('estratos', 'tipo_personas', 'tipo_documentos', 'municipios')->where('per_estado', 1)->get();
        return response()->json($personas);
    }

    public function getUsuario()
    {
        $usuarios = Usuario::with('usaurioPerfil', 'usaurioPerfil.perfil')->where('usu_estado', 1)->get();
        return response()->json($usuarios);
    }

    public function store(Request $request)
    {
        $cliente = $request->cli_codigo;
        $usuario = $request->usu_codigo;
        $tecnico = $request->tec_codigo;

        // if ($cliente) {
        //     $validator = Validator::make($request->all(), [
        //         'per_nombre1' => 'required',
        //         'per_nombre2' => 'required',
        //         'per_apellido1' => 'required',
        //         'per_apellido2' => 'required',
        //         'per_identificacion' => 'required',
        //         'per_email' => 'required|email|unique:personas',
        //         'per_direccion' => 'required',
        //         //TODO: VER COMO GUARDAMOS EL TELEFONO
        //         // 'per_telefono' => 'required',
        //         'per_digito' => 'required',
        //         'per_fecha_nacimiento' => 'required',
        //         // 'est_codigo' => 'required',
        //         // 'tpe_codigo' => 'required',
        //         // 'tdo_codigo' => 'required',
        //         // 'per_mun_nacimiento' => 'required',
        //         'cli_usuario' => 'required|unique:clientes',
        //         'cli_clave' => 'required|min:5'
        //     ], [
        //         'per_nombre1.required' => 'Nombre1 es obligatorio',
        //         'per_nombre2.required' => 'Nombre2 es obligatorio',
        //         'per_apellido1.required' => 'Apellido1 es obligatorio',
        //         'per_apellido2.required' => 'Apellido2 es obligatorio',
        //         'per_identificacion.required' => 'Identificacion es obligatorio',
        //         'per_email.required' => 'Email es obligatorio',
        //         'per_email.email' => 'Email no tiene el formato permitido',
        //         'per_direccion.required' => 'Direccion es obligatorio',
        //         // 'per_telefono.required' => 'Telefono es obligatorio',
        //         'per_digito.required' => 'Digito es obligatorio',
        //         'per_fecha_nacimiento.required' => 'fecha_nacimiento es obligatorio',
        //         // 'est_codigo.required' => 'Estratos es obligatorio',
        //         // 'tpe_codigo.required' => 'Tipo Personas es obligatorio',
        //         // 'tdo_codigo.required' => 'Tipo Documentos coes obligatoriodigo',
        //         // 'per_mun_nacimiento.required' => 'Municipios es obligatorio',
        //         'cli_usuario.required'  => 'Usuario es obligatorio',
        //         'cli_clave.required' => 'Clave es obligatorio',
        //         'cli_clave.min' => 'Clave debe tener minimo 5 caracrteeres',

        //     ]);
        // }
        // if ($usuario) {
        //     $validator = Validator::make($request->all(), [
        //         'per_nombre1' => 'required',
        //         'per_nombre2' => 'required',
        //         'per_apellido1' => 'required',
        //         'per_apellido2' => 'required',
        //         'per_identificacion' => 'required',
        //         'per_email' => 'required|email|unique:personas',
        //         'per_direccion' => 'required',
        //         'per_telefono' => 'required',
        //         'per_digito' => 'required',
        //         'per_fecha_nacimiento' => 'required',
        //         // 'est_codigo' => 'required',
        //         // 'tpe_codigo' => 'required',
        //         // 'tdo_codigo' => 'required',
        //         // 'per_mun_nacimiento' => 'required',
        //         'usu_usuario' => 'required|unique:usuarios',
        //         'usu_clave' => 'required|min:5',
        //     ], [
        //         'per_nombre1.required' => 'Nombre1 es obligatorio',
        //         'per_nombre2.required' => 'Nombre2 es obligatorio',
        //         'per_apellido1.required' => 'Apellido1 es obligatorio',
        //         'per_apellido2.required' => 'Apellido2 es obligatorio',
        //         'per_identificacion.required' => 'Identificacion es obligatorio',
        //         'per_email.required' => 'Email es obligatorio',
        //         'per_email.email' => 'Email no tiene el formato permitido',
        //         'per_direccion.required' => 'Direccion es obligatorio',
        //         'per_telefono.required' => 'Telefono es obligatorio',
        //         'per_digito.required' => 'Digito es obligatorio',
        //         'per_fecha_nacimiento.required' => 'fecha_nacimiento es obligatorio',
        //         // 'est_codigo.required' => 'Estratos es obligatorio',
        //         // 'tpe_codigo.required' => 'Tipo Personas es obligatorio',
        //         // 'tdo_codigo.required' => 'Tipo Documentos coes obligatoriodigo',
        //         // 'per_mun_nacimiento.required' => 'Municipios es obligatorio',
        //         'usu_usuario.required'  => 'Usuario es obligatorio',
        //         'usu_clave.required' => 'Clave es obligatorio',
        //         'usu_clave.min' => 'Clave debe tener minimo 5 caracrteeres',
        //     ]);
        // }
        // if ($tecnico) {
        //     $validator = Validator::make($request->all(), [
        //         'per_nombre1' => 'required',
        //         'per_nombre2' => 'required',
        //         'per_apellido1' => 'required',
        //         'per_apellido2' => 'required',
        //         'per_identificacion' => 'required',
        //         'per_email' => 'required|email|unique:personas',
        //         'per_direccion' => 'required',
        //         'per_telefono' => 'required',
        //         'per_digito' => 'required',
        //         'per_fecha_nacimiento' => 'required',
        //         // 'est_codigo' => 'required',
        //         // 'tpe_codigo' => 'required',
        //         // 'tdo_codigo' => 'required',
        //         // 'per_mun_nacimiento' => 'required',
        //         'tec_fecha_ingreso' => 'required',
        //     ], [
        //         'per_nombre1.required' => 'Nombre1 es obligatorio',
        //         'per_nombre2.required' => 'Nombre2 es obligatorio',
        //         'per_apellido1.required' => 'Apellido1 es obligatorio',
        //         'per_apellido2.required' => 'Apellido2 es obligatorio',
        //         'per_identificacion.required' => 'Identificacion es obligatorio',
        //         'per_email.required' => 'Email es obligatorio',
        //         'per_email.email' => 'Email no tiene el formato permitido',
        //         'per_direccion.required' => 'Direccion es obligatorio',
        //         'per_telefono.required' => 'Telefono es obligatorio',
        //         'per_digito.required' => 'Digito es obligatorio',
        //         'per_fecha_nacimiento.required' => 'fecha_nacimiento es obligatorio',
        //         // 'est_codigo.required' => 'Estratos es obligatorio',
        //         // 'tpe_codigo.required' => 'Tipo Personas es obligatorio',
        //         // 'tdo_codigo.required' => 'Tipo Documentos coes obligatoriodigo',
        //         // 'per_mun_nacimiento.required' => 'Municipios es obligatorio',
        //         'tec_fecha_ingreso.required'  => 'Fecha es obligatorio',
        //     ]);
        // }
        // if ($validator->fails()) {
        //     return response()->json(
        //         [
        //             'code' => 400,
        //             'errors' => $validator->errors()
        //         ]
        //     );
        // } else {
        $persona = Persona::create($request->all());
        if ($persona) {
            // validar si es usuario o cliente
            if ($cliente) {
                $this->storeCliente($persona->id, $request);
                return response()->json(
                    [
                        'message' => 'Cliente registrado exitosamente!',
                        'code' => 200
                    ]
                );
            }
            if ($usuario) {
                $this->storeUsuario($persona->id, $request);
                return response()->json(
                    [
                        'message' => 'Usuario registrado exitosamente!',
                        'code' => 200
                    ]
                );
            }
            if ($tecnico) {
                $this->storeTecnico($persona->id, $request);
                return response()->json(
                    [
                        'message' => 'Tecnico registrado exitosamente!',
                        'code' => 200
                    ]
                );
            }
        } else {
            return response()->json(
                [
                    'message' => 'Error al registrar el usuario!',
                    'code' => 401
                ]
            );
        }
        // }
    }

    public function storeCliente($id, Request $request)
    {
        $cliete = new Cliente();
        $cliete->cli_codigo = $request->cli_codigo;
        $cliete->cli_usuario = $request->cli_usuario;
        $cliete->cli_clave = Hash::make($request->cli_clave);
        $cliete->per_codigo_id = $id;
        $cliete->save();
    }

    public function storeTecnico($id, Request $request)
    {
        $cliete = new Tecnico();
        $cliete->tec_codigo = $request->tec_codigo;
        $cliete->tec_fecha_ingreso = $request->tec_fecha_ingreso;
        $cliete->per_codigo_id = $id;
        $cliete->save();
    }

    public function storeUsuario($id, Request $request)
    {
        $usuario = new Usuario();
        $usuario->usu_codigo = $request->usu_codigo;
        $usuario->usu_usuario = $request->usu_usuario;
        $usuario->usu_clave = Hash::make($request->usu_clave);
        $usuario->per_codigo_id = $id;
        $usuario->save();

        //TODO: ARRAY DE PERFILES Y GUARDARLO EN USUARIO PERFIL

        $modulos = $request->perfil;
        foreach ($modulos as $key) {
            UsuarioPerfilModulo::create(['usuario_id' => $key, 'perfil_id' => $usuario->id]);
        }
    }

    public function edit($id)
    {
        $persona = Persona::findOrFail($id);
        return response()->json(['persona' => $persona]);
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
        $persona = Persona::findOrFail($id);
        $persona = $persona->update($request->all());

        try {
            return response()->json([
                'message' => 'Persona eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Persona no se actualizo exitosamente',
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
        $personaBorrar = Persona::findOrFail($id);
        $personaBorrar->per_estado = 2;
        $personaBorrar->save();
        try {
            return response()->json([
                'message' => 'Persona eliminado exitosamente!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Persona no se actualizo exitosamente',
                'code' => 401
            ]);
        }
    }
}
