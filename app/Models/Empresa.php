<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_codigo', 'emp_codigo', 'emp_estado',
        'emp_nit', 'emp_digito', 'emp_nombre', 'emp_direccion', 'emp_telefono', 'emp_email', 'sed_codigo'
    ];

    public function empresaSede()
    {
        return $this->hasMany(EmpresaSede::class, 'emp_codigo');
    }

    public function plan()
    {
        return $this->hasMany(Plan::class);
    }
}
