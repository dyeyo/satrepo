<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    use HasFactory;
    protected $filalble = ['tec_codigo', 'tec_fecha_ingreso', 'tec_estado', 'per_codigo_id'];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'per_codigo_id');
    }
}
