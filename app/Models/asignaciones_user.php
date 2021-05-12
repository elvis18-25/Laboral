<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asignaciones_user extends Model
{
    use HasFactory;
    protected $table='asignaciones_user';

    protected $fillable = [
        'asignaciones_id',
        'id_user',
        'id_empresa',
        'monto',
    ];

    protected $cats = [
        'onoffswitch' => 'array',
    ];
}
