<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empleados_equipo extends Model
{
    use HasFactory;
    protected $table='equipos_empleados';

    protected $fillable = [
        'equipos',
        'id_empleado',
        'id_empresa',
        'estado',
    ];


    protected $guarded = [];
}
