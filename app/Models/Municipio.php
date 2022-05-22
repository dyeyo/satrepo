<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $fillable = ['mun_codigo', 'mun_nombre', 'mun_estado', 'dep_codigo'];

    public function departamentos()
    {
        return $this->belongsTo(Departamento::class, 'dep_codigo');
    }

    public function empresaSede()
    {
        return $this->hasMany(EmpresaSede::class);
    }

    public function persona()
    {
        return $this->hasMany(Persona::class);
    }
    public function oferta()
    {
        return $this->hasMany(Oferta::class);
    }
}
