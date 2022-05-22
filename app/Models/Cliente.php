<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $filalble = ['cli_codigo', 'cli_usuario', 'cli_clave', 'cli_estado', 'per_codigo_id'];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'per_codigo_id');
    }

    public function inscripcion()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
