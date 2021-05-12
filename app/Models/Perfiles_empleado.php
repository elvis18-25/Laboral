<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfiles_empleado extends Model
{
    use HasFactory;

    protected $table='perfiles_empleado';
    protected $column='id,descripcion';

    protected $fillable = [
        'id',  
        'descripcion'
    ];
}
