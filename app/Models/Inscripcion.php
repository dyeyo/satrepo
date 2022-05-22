<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;
    protected $fillable = [
        'ins_codigo',
        'ins_fecha',
        'ins_fecha_inicio',
        'ins_fecha_fin',
        'ins_ip',
        'ins_estado',
        'ins_direccion',
        'cli_codigo',
        'ofe_codigo',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cli_codigo');
    }

    public function oferta()
    {
        return $this->belongsTo(Oferta::class, 'ofe_codigo');
    }
}
