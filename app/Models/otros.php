<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class otros extends Model
{
    use HasFactory;
    protected $table='otros';

    protected $fillable = [
        'id_empleado',
        'id', 
        'tipo',
        'monto', 
        'descripcion'
    ];
}
