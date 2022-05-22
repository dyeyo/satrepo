<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Oferta extends Model
{
    use HasFactory;
    protected $fillable = ['ofe_codigo', 'ofe_valor', 'ofe_fecha', 'ofe_estado', 'mun_codigo', 'pla_codigo', 'ese_codigo'];

    public function empresaSede()
    {
        return $this->belongsTo(EmpresaSede::class, 'ese_codigo');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'pla_codigo');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'mun_codigo');
    }

    public function inscripcion()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
