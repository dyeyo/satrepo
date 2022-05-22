<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
    protected $fillable = ['dep_codigo', 'dep_nombre', 'dep_estado', 'pai_codigo'];

    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'dep_codigo', 'id');
    }

    public function paises()
    {
        return $this->belongsTo(Paises::class, 'id');
    }
}
