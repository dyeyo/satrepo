<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pla_codigo',
        'pla_megas',
        'pla_condiciones',
        'pla_decripcion',
        'pla_estado',
        'emp_codigo',
        'tpa_codigo',
        'cat_codigo'
    ];


    public function empresas()
    {
        return $this->belongsTo(Empresa::class, 'emp_codigo');
    }

    public function tipo_planes()
    {
        return $this->belongsTo(TipoPlan::class, 'tpa_codigo');
    }

    public function categorias()
    {
        return $this->belongsTo(Categorias::class, 'cat_codigo');
    }

    public function oferta()
    {
        return $this->hasMany(Oferta::class);
    }
}
