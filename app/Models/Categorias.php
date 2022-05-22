<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;
    protected $fillable = ['cat_codigo', 'cat_nombre', 'cat_descripcion', 'cat_estado'];

    public function plan()
    {
        return $this->hasMany(Plan::class);
    }
}
