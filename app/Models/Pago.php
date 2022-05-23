<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = ['pag_codigo', 'pag_fecha', 'pag_valor', 'pag_estado', 'liq_codigo', 'usu_codigo', 'fpa_codigo'];
}
