<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    use HasFactory;

    protected $fillable = ['liq_codigo', 'liq_dias', 'liq_valor', 'ins_codigo', 'prod_codigo', 'est_codigo'];
}
