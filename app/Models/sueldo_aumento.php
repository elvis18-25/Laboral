<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sueldo_aumento extends Model
{
    use HasFactory;
    protected $table="sueldoaumentos";

    protected $fillable = [
        'id_empleado',
        'sueldo_base',
        'sueldo_increment',
        'description',
        'user',
        'estado',
        'id_empresa',

    ];
}
