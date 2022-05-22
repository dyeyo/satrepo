<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $fillable = [
        'per_codigo', 'per_nombre1', 'per_nombre2', 'per_apellido1', 'per_apellido2',
        'per_identificacion', 'per_email', 'per_direccion', 'per_telefono', 'per_digito',
        'per_fecha_nacimiento', 'est_codigo', 'tpe_codigo', 'tdo_codigo', 'per_mun_nacimiento'
    ];

    public function estratos()
    {
        return $this->belongsTo(Estrato::class, 'est_codigo');
    }

    public function tipo_personas()
    {
        return $this->belongsTo(TipoPersona::class, 'tpe_codigo');
    }

    public function tipo_documentos()
    {
        return $this->belongsTo(TipoDocumento::class, 'tdo_codigo');
    }

    public function municipios()
    {
        return $this->belongsTo(Municipio::class, 'per_mun_nacimiento');
    }

    public function cliente()
    {
        return $this->hasMany(Cliente::class);
    }

    public function usuarios()
    {
        return $this->hasMany(Cliente::class);
    }

    public function tecnico()
    {
        return $this->hasMany(Tecnico::class);
    }
}
