<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorias_sub extends Model
{
    use HasFactory;
    protected $table='categorias_sub';

    protected $fillable = [
        'id_sub',
        'id_categorias',
        'id_empresa',
        'estado',
    ];
}
