<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfiles extends Model
{
    use HasFactory;
    protected $fillable = ['pfl_codigo', 'pfl_nombre', 'pfl_descripcion', 'pfl_estado'];

    public function perfilModulo()
    {
        return $this->hasMany(PerfilModuloPerfiles::class);
    }

    public function usaurioPerfil()
    {
        return $this->hasMany(UsuarioPerfilModulo::class);
    }
}
