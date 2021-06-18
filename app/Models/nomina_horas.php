<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nomina_horas extends Model
{
    use HasFactory;
    protected $table='nominas_horas';

    protected $fillable = [
        'id_empleado',
        'id_nomina',
        'horaentrada',
        'horasalidad',
        'jornada',
        'fechainicio',
        'fechafinalizado',
        'monto',
        'type',
        'horas',
        'estado',
        'id_empresa',
    ];


    protected $guarded = [];
}
