<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nomina_otros extends Model
{
    use HasFactory;
    protected $table='nomina_otros';

    protected $fillable = [
        'id_empleado',
        'id_nomina',
        'descripcion',
        'tipo',
        'tipo_asigna',
        'p_monto',
        'monto',
        'id_empresa',
        'estado',
    ];


    protected $guarded = [];
}
