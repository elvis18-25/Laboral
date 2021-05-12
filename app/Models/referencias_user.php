<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class referencias_user extends Model
{
    use HasFactory;
    protected $table='referencias_user';

    protected $fillable = [
        'user_id',
        'nombre',
        'telefono',
        'parentesco',
        'id_empresa',
        'estado',

    ];

    protected $cats = [
        'user_id'              => 'array',
        'parentesco'           => 'array',
        'emple'                => 'array',
        'nombre'               => 'array',
        'telefono'             => 'array',
        'emple'                => 'array',
    ];
}
