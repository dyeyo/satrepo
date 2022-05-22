<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPlan extends Model
{
    use HasFactory;
    protected $fillable = ['tpa_codigo', 'tpa_nombre', 'tpa_descripcion', 'tpa_estado'];

    public function plan()
    {
        return $this->hasMany(Plan::class);
    }
}
