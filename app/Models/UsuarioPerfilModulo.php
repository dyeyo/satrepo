<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioPerfilModulo extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'usuario_id', 'perfil_id'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function perfil()
    {
        return $this->belongsTo(Perfiles::class, 'perfil_id');
    }
}
