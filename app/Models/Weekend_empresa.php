<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weekend_empresa extends Model
{
    use HasFactory;
    protected $table='weekend_empresa';
    protected $fillable = [
        'id_weekend',
        'id_empresa',
        'start',
        'end',
        'incremento',
        'laboral',
        'estado',

    ];


    protected $guarded = [];
}
