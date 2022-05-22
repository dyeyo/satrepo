<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estrato extends Model
{
    use HasFactory;
    protected $fillable = ['est_codigo', 'est_nombre', 'est_cobro_iva', 'est_estado'];

    public function persona()
    {
        return $this->hasMany(Persona::class);
    }
}
