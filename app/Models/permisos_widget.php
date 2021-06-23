<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permisos_widget extends Model
{
    use HasFactory;
    protected $table='permisos_widget';
    protected $guarded = [];

    protected $fillable = [
        'total_empleado',
        'role_id',
        'total_usuarios',
        'total_departamentos'  ,
        'formas_pago'          ,
        'totales_roles'        ,
        'reuniones'            ,
        'w_empleados'          ,
        'w_departamentos'      ,
        'w_generos'            ,
        'g_gasto'              ,
        'historial'            ,
        'calendario'           , 
        'id_empresa'           ,
        'estado'               ,
    ];

    // protected $guarded = [];
}
