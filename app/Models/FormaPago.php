<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    use HasFactory;
    protected $fillable = ['fpa_codigo', 'fpa_nombre', 'fpa_descripcion', 'fpa_estado'];
}
