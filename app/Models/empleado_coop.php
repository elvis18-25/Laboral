<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empleado_coop extends Model
{
    use HasFactory;
    protected $table='empleados_coop';

    protected $fillable = [
        'id_coop',
        'id_empleado',
        'monto',
        'balance',
        'id_empresa',
        'estado',

    ];


    protected $guarded = [];


}
