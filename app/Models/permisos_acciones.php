<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permisos_acciones extends Model
{
    use HasFactory;
    protected $table='permisos_acciones';
    protected $guarded = [];

    protected $fillable = [
        'calcular_horas',
        'role_id',
        'imprimir_gastos',
        'id_empresa',

    ];
}
