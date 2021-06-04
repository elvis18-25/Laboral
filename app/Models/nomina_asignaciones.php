<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nomina_asignaciones extends Model
{
    use HasFactory;
    protected $table='nomina_asignaciones';

    protected $fillable = [
        'id_empleado',
        'id_nomina',
        'id_asignaciones',
        'nombre',
        'tipo_asigna',
        'tipo',
        'montos',
        'estado_asigna',
        'id_empresa',
        'estado',
        'salarioBruto',
    ];


    protected $guarded = [];
}
