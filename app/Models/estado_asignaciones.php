<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estado_asignaciones extends Model
{
    use HasFactory;
    protected $table='estado_asignaciones';

    protected $fillable = [
        'estado',
        'id_asignaciones',
        'id_empleado',
        'id_empresa',
    ];

    protected $cats = [
        'onoffswitch' => 'array',
     

    ];
}
