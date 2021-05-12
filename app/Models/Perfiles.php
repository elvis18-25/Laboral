<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfiles extends Model
{
    use HasFactory;
    protected $table='perfiles';

    protected $fillable = [
        'id_perfiles',
        'id_empleado',
        'id_empresa',
        'estados',

    ];


    protected $guarded = [];

}
