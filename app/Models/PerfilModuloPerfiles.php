<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilModuloPerfiles extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'perfiles_id', 'modulos_id'];

    public function perfil()
    {
        return $this->belongsTo(Perfiles::class, 'perfiles_id');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulos_id');
    }
}
