<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nomina_empleados extends Model
{
    use HasFactory;
    protected $table='nomina_empleador';

    protected $fillable = [
        'id_empleado',
        'id_nomina',
        'deducion',
        'salarioBruto',
        'incremento',
        'horas',
        'id_empresa',
        'estado',
    ];


    protected $guarded = [];
}
