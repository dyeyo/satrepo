<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaSede extends Model
{
    use HasFactory;
    protected $fillablee = ['ese_codigo', 'sed_codigo', 'emp_codigo', 'num_codigo'];

    public function sede()
    {
        return $this->belongsTo(Sedes::class, 'sed_codigo');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'emp_codigo');
    }


    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'num_codigo');
    }

    public function oferta()
    {
        return $this->hasMany(Oferta::class);
    }

    public function vinculacion()
    {
        return $this->hasMany(Vinculaciones::class);
    }
}
