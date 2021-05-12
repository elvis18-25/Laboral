<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concepto_gasto extends Model
{
    use HasFactory;
    protected $table='conceptos_gastos';
    protected $column='id';


    protected $fillable = [
        'id_gasto',
        'concepto',
        'monto',
        'id_empresa',
        'estado',
    ];

    protected $cats = [
        'descripcion' => 'array',
        'monto' => 'array',
        'id_empresa' => 'array',
        'estado' => 'array',
     

    ];
}
