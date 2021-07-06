<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignaciones_empleado extends Model
{
    use HasFactory;

    protected $table='asignaciones_empleado';
    // protected $column='empleado_id_empleado,asignaciones_id,create_at,update_at,id_empresa"';

    protected $fillable = [
        'empleado_id_empleado',
        'asignaciones_id',
        'id_empresa',
        'estado',
    ];


}
