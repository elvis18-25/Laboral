<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencias extends Model
{
    use HasFactory;
    protected $table='referencias';
    protected $column='nombre,telefono,create_at,update_at';

    protected $fillable = [
        'empleado_id_empleado',
        'nombre',
        'telefono',
        'parentesco',
        'id_empresa',
        'estado',

    ];

    protected $cats = [
        'empleado_id_empleado' => 'array',
        'parentesco'           => 'array',
        'emple'                => 'array',
        'nombre'               => 'array',
        'telefono'             => 'array',
        'emple'                => 'array',
    ];
}
