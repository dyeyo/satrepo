<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPersona extends Model
{
    use HasFactory;
    protected $fillable = ['tpe_codigo', 'tpe_nombre', 'tpe_estado'];

    public function persona()
    {
        return $this->hasMany(Persona::class);
    }
}
