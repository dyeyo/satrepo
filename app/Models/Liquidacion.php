<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    use HasFactory;

    protected $fillable = ['liq_codigo', 'liq_dias', 'liq_valor', 'ins_codigo', 'prod_codigo', 'est_codigo', 'tipo_creacion'];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'prod_codigo');
    }


    public function estado()
    {
        return $this->belongsTo(Estado::class, 'est_codigo');
    }


    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class, 'ins_codigo');
    }
}
