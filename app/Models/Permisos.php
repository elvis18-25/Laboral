<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    use HasFactory;
    protected $table='permisos';

    protected $fillable = [
        'role_id' ,
        'empleado'          ,
        'usuario'           ,
        'departamento'      ,
        'roles'             ,
        'gastos'            ,
        'perfiles'          ,
        'nomina'            ,
        'formas_pagos'      ,
        'contrato'          , 
        'asignaciones'      ,
        'perfilesuser'      ,
        'asistencia'        ,
        'empresa'           ,
        'grupo'             ,
        'id_empresa'        ,  
    ];
}
