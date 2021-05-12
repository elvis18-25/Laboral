<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjuntos extends Model
{
    use HasFactory;

    protected $table='adjunto';
    protected $column='name,create_at,update_at';

    protected $fillable = [
        'name',
        'id_empleado',
        'descripcion'
    ];

    protected $cats = [
        'one' => 'array',
        'two' => 'array',

    ];
}
