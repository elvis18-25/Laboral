<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategorias extends Model
{
    use HasFactory;
    protected $table='sub_categorias';

    
    protected $fillable = [
        'nombre',
        'id_empresa',
        'estado',
        'id_subed',
    ];
}
