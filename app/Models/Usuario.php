<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $filalble = ['usu_codigo', 'usu_usuario', 'usu_clave', 'usu_estado', 'per_codigo_id'];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'per_codigo_id');
    }

    public function usaurioPerfil()
    {
        return $this->hasMany(UsuarioPerfilModulo::class);
    }

    public function vinculacion()
    {
        return $this->hasMany(Vinculaciones::class);
    }
}
