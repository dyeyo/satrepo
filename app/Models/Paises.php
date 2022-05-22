<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
    use HasFactory;

    protected $fillable = ['pai_codigo', 'pai_nombre', 'pai_estado'];

    public function paises()
    {
        return $this->hasMany(Departamento::class, 'id');
    }
}
