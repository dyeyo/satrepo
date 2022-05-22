<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;
    protected $fillable = ['mod_codigo', 'mod_nombre', 'mod_descripcion', 'mod_estado'];

    public function perfilModulo()
    {
        return $this->hasMany(PerfilModuloPerfiles::class);
    }
}
