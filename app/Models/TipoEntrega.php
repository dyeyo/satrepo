<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEntrega extends Model
{
    use HasFactory;
    protected $fillable = ['ten_codigo', 'ten_nombre', 'ten_descripcion', 'ten_estado'];
}
