<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gasto_nomina extends Model
{
    use HasFactory;
    protected $table='gastos_nominas';

    protected $fillable = [
        'id_gasto',
        'id_nomina',
        'descripcion',
        'monto',
        'id_empresa',
        'estado',
    ];

    protected $guarded = [];
}
