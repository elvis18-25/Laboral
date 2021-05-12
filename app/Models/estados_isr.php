<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estados_isr extends Model
{
    use HasFactory;
    protected $table='estados_isr';

    protected $fillable = [
        'estado',
        'id_isr',
        'id_empleado',
        'id_empresa',
    ];

    protected $cats = [
        'onoffswitch' => 'array',
     

    ];
}
