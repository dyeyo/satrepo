<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vinculaciones extends Model
{
    use HasFactory;
    protected $fillablee = ['vin_fecha_inicio', 'vin_fecha_fin', 'vin_estado', 'usuario_id', 'empresa_sede_id'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function empresaSede()
    {
        return $this->belongsTo(EmpresaSede::class, 'empresa_sede_id');
    }
}
