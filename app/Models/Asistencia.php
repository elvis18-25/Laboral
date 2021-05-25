<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $table='asistencia';

    protected $fillable = [
        'id_empleado',
        'notas',
        'entrada',
        'salidad',
        'user',
        'id_empresa',
        'estado',
    ];

    protected $cats = [
        'entrada' => 'date',
        'salidad' => 'date',
    ];
}
