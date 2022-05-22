<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;
    protected $fillable = ['tdo_codigo', 'tdo_nombre', 'tdo_estado'];

    public function persona()
    {
        return $this->hasMany(Persona::class);
    }
}
